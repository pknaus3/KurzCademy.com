/**
 * @typedef {{
 *  name : string,
 *  publisher : string,
 *  difficulty : string, 
 *  description : string,
 *  teacher_name : string,
 *  id: number
 * }} CourseData
 * 
 * @typedef {{
 *  id: number,
 *  step_name: string,
 *  type: "googleDoc" | "youtube" | "html" | "markdown",
 *  link: string
 * }} StepData
 */

class CourseEditor {
    constructor() {
        /** @type {CourseData} */
        this.course = null
        /** @type {StepData[]} */
        this.steps = null
        this.vm = new Vue({
            el: "#editor",
            data: {
                steps: this.steps,
                name: "Loading...",
                currStep: null
            }
        })
        this.id = 0

        this.id = parseInt(location.search.substr(1))
        if (isNaN(this.id)) {
            this.vm.name = "Invalid course ID"
            throw new Error("Invalid course ID")
        }
    }

    /** @returns {Promise<void>} */
    update() {

        return new Promise((resolve, reject) => {
            $(this).request("onRequestUpdate", {
                data: {
                    id: this.id
                },
                success: ( /** @type {{course: CourseData[], steps: StepData[]}} */ data) => {
                    if (data.course.length == 0) {
                        this.vm.name = "Course not found"
                        reject()
                        throw new Error("Course not found")
                    } else {
                        this.course = data.course[0]
                        this.steps = data.steps

                        this.vm.name = this.course.name
                        this.vm.steps = this.steps
                        if (this.steps.length > 0) this.vm.currStep = this.steps[0]
                        resolve()
                    }
                }
            })
        })
    }

    createNewStep() {
        $.request("onCreateNewStep", {
            data: {
                id: this.id,
                position: this.steps.length
            },
            success: (/** @type {{id : number}} */ data) => {
                this.update().then(() => {
                    this.vm.currStep = this.steps[this.steps.length - 1]
                })
            }
        })
    }

    saveStep() {
        if (this.vm.currStep == null) return
        $.request("onSaveStep", {
            data: {
                ...this.vm.currStep,
                courseId: this.id
            },
            success: (data) => {
                debugger;
            }
        })
    }
}