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
 *  link: string,
 *  position: number
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
            },
            methods: {
                deleteStep: (step) => this.deleteStep(step),
                moveStep: (step, offset) => this.moveStep(step, offset)
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
                        this.vm.steps = this.steps.sort((a, b) => a.position - b.position)
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

    saveStep(/** @type {StepData} */ step) {
        $.request("onSaveStep", {
            data: {
                ...step,
                courseId: this.id
            }
        })
    }

    deleteStep(/** @type {StepData} */ step) {
        $.request("onDeleteStep", {
            data: {
                id: step.id,
                courseId: this.id
            },
            success: () => {
                this.update()
            }
        })
    }

    moveStep(/** @type {StepData} */ step, /** @type {number} */ offset) {
        var exchange = this.vm.steps[this.vm.steps.indexOf(step) + offset]
        if (exchange) {
            var newPosition = exchange.position
            exchange.position = step.position
            step.position = newPosition
            this.vm.steps = this.vm.steps.sort((a, b) => a.position - b.position)

            this.saveStep(exchange)
            this.saveStep(step)
        }
    }
}