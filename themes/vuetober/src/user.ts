import Vue from "vue"
import axios from "axios"

export interface IUserData {
    password_confirmation?: string
    email: string
    id: string
    name: string
    username: string
    avatar: string
    password?: string
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

export async function updateUserData(fullName: string, email: string, newPassword: string | null = null) {
    if (userData.user == null) throw new Error("Cannot update user data with no user logged in")

    userData.user.name = fullName
    userData.user.email = email
    if (newPassword != null) userData.user.password_confirmation = userData.user.password = newPassword

    let response = await axios.post<IUserData>(`/api/rainlab/user/account`, userData.user)
    console.log("Update user data", response.data)
}