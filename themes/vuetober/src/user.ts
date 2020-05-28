import Vue from "vue"
import axios from "axios"
import router from './router'

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
    try {
        let userResponse = await axios.get<IUserData>(`/api/rainlab/user/account`)
        userData.user = userResponse.data
        console.log("Logged in", userData.user)
    } catch (err) {
        console.log("Not logged in", err.response.data, err)
        userData.user = null
    }
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

export async function logout() {
    await axios.get(`/api/rainlab/user/auth/logout`)
    await loadUserData()
    router.push("/")
}

export async function login(login: string, password: string) {
    await axios.post(`/api/rainlab/user/auth/login`, { login, password })
    await loadUserData()
}