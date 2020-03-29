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

    constructor(/** @type {CourseData[]} */ foundCourses) {
        if (foundCourses.length > 0) {
            this.courseData = foundCourses[0]
        } else {
            this.courseData = null
        }

        /** @type {{ course: CourseData, steps: StepData[], currStep: StepData | null, found: boolean }} */
        this.vm = new Vue({
            data: {
                course: this.courseData,
                steps: [],
                currStep: null,
                found: foundCourses.length > 0
            },
            el: "#viewer"
        })
    }
}