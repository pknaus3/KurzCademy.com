export interface ICourse {
    id: number
    created_at: Date
    updated_at: Date
    name: string
    publisher: string
    difficulty: string
    description: string
    teacher_name: string
    coursecolor: string,
    thumbPath: string
}

export interface IStep {
    id: number
    created_at: Date
    updated_at: Date
    course_name: string
    step_name: string
    video_link: string
    docs_link: string
    custom_text: string
    step_position: number
    why: string,
    homework: boolean
    renderedDocsHtml: string
}