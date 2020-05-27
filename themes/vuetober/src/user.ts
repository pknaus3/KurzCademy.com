import Vue from "vue"
import axios from "axios"

export interface IUserData {
    email: string
    id: string
    name: string
    username: string
    avatar: string
}

export const userData = Vue.observable({
    user: null as null | IUserData
})

export async function loadUserData() {
    let userResponse = await axios.get<IUserData>(`/api/rainlab/user/account`)
    userData.user = userResponse.data
    // let avatarResponse = await axios.get<string>(`/api/user-avatar`)
    // userData.user!.avatar = avatarResponse.data
}