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
    }

    /** @returns {Promise<void>} */
    update() {
        var id = 0

        id = parseInt(location.search.substr(1))
        if (isNaN(id)) {
            this.vm.name = "Invalid course ID"
            throw new Error("Invalid course ID")
        }

        return new Promise((resolve, reject) => {
            $(this).request("onRequestUpdate", {
                data: {
                    id: id
                },
                success: ( /** @type {{course: CourseData[], steps: StepData[]}} */ data) => {
                    if (data.course.length == 0) {
                        this.vm.name = "Course not found"
                        throw new Error("Course not found")
                    } else {
                        this.course = data.course[0]
                        this.steps = data.steps

                        this.vm.name = this.course.name
                        this.vm.steps = this.steps
                        if (this.steps.length > 0) this.vm.currStep = this.steps[0]
                    }
                }
            })
        })
    }
}