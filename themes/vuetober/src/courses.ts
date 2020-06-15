import axios, { AxiosResponse } from "axios"
import { userData, IUserData, createAuthHeaders } from './user'

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

export interface IComment {
    id: number
    comment: string
    course_id: string
    user_id: string,
    user: IUserData,
    isOwner: boolean
}

export async function getStepById(id: string) {
    let stepResponse = await axios.get<IStep>(`/api/step/${id}`)
    if (stepResponse.data.renderedDocsHtml == null) {
        stepResponse.data.renderedDocsHtml = ""
    }
    return stepResponse.data
}

export async function getCourseById(id: string) {
    let stepResponse = await axios.get<ICourse>(`/api/course/${id}`)
    return stepResponse.data
}

export async function getCourseStepsById(courseId: string) {
    let stepsResponse = await axios.get<IStep[]>(`/api/steps/${courseId}`)
    return stepsResponse.data
}

export async function getAllCourses(max: number = -1) {
    let coursesResponse = await axios.get<ICourse[]>(`/api/courses/${max}`)
    return coursesResponse.data
}

export async function getCourseFavourite(courseId: string) {
    if (userData.user == null) throw new Error("Tryed to get favourite state of a course with no user")
    return (await axios.get<number>(`/api/favoritesCourses/${courseId}`, createAuthHeaders())).data == 1
}

export async function setCourseFavourite(courseId: string, value: boolean) {
    if (userData.user == null) throw new Error("Tryed to set favourite state of a course with no user")
    let oldValue = await getCourseFavourite(courseId)
    if (oldValue != value) {
        if (value == true) {
            await axios.post(`/api/addFavorite`, {
                course_id: courseId
            }, createAuthHeaders())
        } else {
            await axios.delete(`/api/deleteFavorite/${courseId}`, createAuthHeaders())
        }
    }
}

export async function getAllFavouritedCourses() {
    if (userData.user == null) throw new Error("Tryed to get favourite courses with no user")
    return (await axios.get<ICourse[]>(`/api/favoritesCourses`, createAuthHeaders())).data
}

export async function createComment(courseId: string, content: string) {
    if (userData.user == null) throw new Error("Tryed to create comment with no user")
    await axios.post(`/api/comment`, {
        comment: content,
        course_id: courseId,
    } as IComment, createAuthHeaders())
}

export async function deleteComment(commentId: string) {
    await axios.delete(`/api/deleteComment/${commentId}`, createAuthHeaders())
}

export async function getAllStepComments(stepId: string) {
    return (await axios.get<IComment[]>(`/api/comments/${stepId}`)).data.map(v => ({ ...v, isOwner: userData.user != null && v.user.id == userData.user.id }))
}

export async function getStepChecked(stepId: string) {
    return (await axios.post<number | null>(`/api/getCheck/`, { step_id: stepId }, createAuthHeaders())).data == 1
}

export async function setStepChecked(stepId: string, checked: boolean) {
    if (checked != await getStepChecked(stepId)) {
        if (checked) {
            await axios.post(`/api/check`, {
                step_id: stepId
            }, createAuthHeaders())
        } else {
            await axios.delete(`/api/uncheck/${stepId}`, createAuthHeaders())
        }
    }
}
