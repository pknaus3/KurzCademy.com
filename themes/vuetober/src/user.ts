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
                setUserData(null)
                setToken(null)
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
    setUserData(response.data.response.user)
    setToken(response.data.response.token)
}

export async function updateUserAvatar(avatar: File) {
    throw new Error("Updating user avatar not implemented yet")
}

export async function deleteAvatar() {
    throw new Error("Deleting user avatar not implemented yet")
}

export async function logout() {
    setUserData(null)
    setToken(null)

    reevaluteRouteGuard()
}

export async function login(login: string, password: string) {
    let response = await axios.post<IAuthAPIResponse>(`/api/v1/auth/login`, {
        login: login,
        password: password
    })
    setUserData(response.data.response.user)
    setToken(response.data.response.token)
}

function setUserData(user: IUserData | null) {
    userData.user = user

    if (userData.user) {
        if (userData.user.avatar == null) {
            userData.user.avatar = { path: "" }
        }
    }
}

function setToken(token: string | null) {
    userData.token = token
    if (token != null) localStorage.setItem(LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME, token)
    else localStorage.removeItem(LOCAL_STORAGE_JWT_TOKEN_ITEM_NAME)
}