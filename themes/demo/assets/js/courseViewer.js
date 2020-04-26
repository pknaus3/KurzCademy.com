/**
 * @typedef {{
 *  id: number,
 *  created_at: Date,
 *  updated_at: Date,
 *  name: string,
 *  publisher: string,
 *  difficulty: string,
 *  description: string,
 *  teacher_name: string
 * }} CourseData
 * 
 * @typedef {{
 *  id: number,
 *  created_at: Date,
 *  updated_at: Date,
 *  course_name: string,
 *  step_name: string,
 *  video_link: string,
 *  docs_link: string,
 *  custom_text: string,
 *  step_position: number
 * }} StepData
 */


class CourseViewer {

    constructor(/** @type {CourseData[]} */ course, /** @type {StepData[] | null} */ steps, /** @type {boolean} */ loggedIn) {
        if (course) {
            this.courseData = course[0]
        } else {
            this.courseData = null
        }

        this.steps = steps || []

        this.steps.sort((a, b) => {
            if (isNaN(a.step_position)) {
                console.warn(`Step ${a.id} does not have a position`)
            }

            if (isNaN(b.step_position)) {
                console.warn(`Step ${b.id} does not have a position`)
            }

            return a.step_position - b.step_position
        })

        /** @type {{ course: CourseData, steps: StepData[], currStep: StepData | null, found: boolean }} */
        this.vm = new Vue({
            data: {
                course: this.courseData,
                steps: this.steps,
                currStep: null,
                found: this.courseData != null,
                loading: false,
                loggedIn: loggedIn,
                buttons: null,
                active: ""
            },
            el: "#viewer",
            methods: {
                selectStep(/** @type {StepData} */ step) {
                    this.currStep = step
                    this.loading = true
                    this.buttons = null
                },
                setState(/** @type {string} */ state) {
                    this.$refs.iframe.contentWindow.setState(state)
                    this.active = state
                }
            },
            watch: {
                loading(newValue, oldValue) {
                    if (oldValue == true && newValue == false) {
                        this.buttons = this.$refs.iframe.contentWindow.getAvalible()
                        if (this.buttons.length > 0) this.active = this.buttons[0].value
                        else this.active = ""
                    }
                }
            }
        })
    }
}