import Vue from "vue"
import axios from "axios"
import router from './router'

export interface IUserData {
    password_confirmation?: string
    email: string
    id: string
    name: string
    username: string
    avatar: IAvatar
    password?: string
}

export interface IAvatar {
    path: string
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

    if (userData.user) {
        if (userData.user.avatar == null) {
            userData.user.avatar = { path: "" }
        }
    }
}

export async function updateUserData(fullName: string, email: string, newPassword: string | null = null) {
    if (userData.user == null) throw new Error("Cannot update user data with no user logged in")
    
    userData.user.name = fullName
    userData.user.email = email
    if (newPassword != null) userData.user.password_confirmation = userData.user.password = newPassword
    
    let response = await axios.post<IUserData>(`/api/rainlab/user/account`, userData.user)
    console.log("Update user data", response.data)
}

export async function updateUserAvatar(avatar: File) {
    if (userData.user == null) throw new Error("Cannot update user avatar with no user logged in")
    
    let formData = new FormData()
    formData.append("avatar", avatar)
    
    await axios.post("/api/rainlab/user/account", formData)
    await loadUserData()
}

export async function deleteAvatar() {
    if (userData.user == null) throw new Error("Cannot delete user avatar with no user logged in")
    
    await axios.delete(`/api/rainlab/user/account/avatar`)
    await loadUserData()
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