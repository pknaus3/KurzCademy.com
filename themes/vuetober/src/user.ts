import Vue from "vue"
import axios, { AxiosRequestConfig, AxiosError } from "axios"
import router, { reevaluteRouteGuard } from './router'

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

export interface IAuthAPIResponse {
    response: {
        user: IUserData,
        token: string
    }
}

const LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME = "jwt_token"

export const userData = Vue.observable({
    user: null as null | IUserData,
    token: localStorage.getItem(LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME) as string | null
})

export async function loadUserData() {
    if (userData.token) {
        try {
            setUserData((await axios.get<IAuthAPIResponse>(`/api/v1/auth/info`, createAuthHeaders())).data.response.user)
        } catch {
            try {
                setToken((await axios.post<IAuthAPIResponse>(`/api/v1/auth/refresh`, {}, createAuthHeaders())).data.response.token)
                setUserData((await axios.get<IAuthAPIResponse>(`/api/v1/auth/info`, createAuthHeaders())).data.response.user)
            } catch {
                setToken(null)
                setUserData(null)
            }
        }
    }
}

export function createAuthHeaders() {
    if (userData.token == null) throw new Error("Tryied to create auth headers with no token saved")
    return {
        headers: {
            Authorization: `Bearer ${userData.token}`
        }
    } as AxiosRequestConfig
}

export async function updateUserData(fullName: string, email: string, newPassword: string | null = null) {
    if (userData.user == null) throw new Error("Cannot update user data with no user logged in")

    let newUser = { ...userData.user }
    newUser.name = fullName
    newUser.email = email
    if (newPassword != null) newUser.password_confirmation = newUser.password = newPassword

    let response = await axios.post<IAuthAPIResponse>(`/api/v1/auth/info`, newUser, createAuthHeaders())
    setUserData(response.data.response.user)
    console.log("Update user data", response.data.response.user)
}

export async function registerUser(fullName: string, email: string, password: string) {
    let response = await axios.post<IAuthAPIResponse>(`/api/v1/auth/signup`, {
        password,
        password_confirmation: password,
        email,
        name: fullName
    })
    console.log("Registered user", response.data)
    setToken(response.data.response.token)
    setUserData(response.data.response.user)
}

export async function updateUserAvatar(avatar: File) {
    if (userData.user == null) throw new Error("Cannot update user avatar with no user logged in")

    let formData = new FormData()
    formData.append("avatar", avatar)

    await axios.post("/api/user/avatar", formData, createAuthHeaders())
    await loadUserAvatar()
}

export async function deleteAvatar() {
    await axios.post(`/api/user/avatar`, { avatar: null }, createAuthHeaders())
    await loadUserAvatar()
}

export async function logout() {
    setToken(null)
    setUserData(null)

    reevaluteRouteGuard()
}

export async function login(login: string, password: string) {
    let response = await axios.post<IAuthAPIResponse>(`/api/v1/auth/login`, {
        login: login,
        password: password
    })
    setToken(response.data.response.token)
    setUserData(response.data.response.user)
}

function setUserData(user: IUserData | null) {
    userData.user = user

    if (userData.user) {
        if (userData.user.avatar == null) {
            Vue.set(userData.user, "avatar", { path: "" })
        }

        loadUserAvatar()
    }
}

async function loadUserAvatar() {
    if (userData.user == null) throw new Error("Tryied to load user avatar without a user")
    let avatarPath = (await axios.get<string>(`/api/user/getAvatar`, createAuthHeaders())).data
    userData.user.avatar.path = avatarPath.toString()
}

function setToken(token: string | null) {
    userData.token = token
    if (token != null) localStorage.setItem(LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME, token)
    else localStorage.removeItem(LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME)
}