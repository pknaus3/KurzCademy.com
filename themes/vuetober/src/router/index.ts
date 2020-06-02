import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Home from '../views/Home.vue'
import { userData } from '@/user'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: "/courses",
        name: "Courses",
        component: () => import("@/components/Courses.vue")
    },
    {
        path: "/favourites",
        name: "Favourites",
        component: () => import("@/components/Courses.vue"),
        props: { favouriteOnly: true },
        meta: {
            authReq: true
        }
    },
    {
        path: "/course/:id",
        props: true,
        name: "Course",
        component: () => import("@/views/CourseView.vue"),
        meta: {
            hideFooter: true
        },
        children: [
            {
                path: ":stepId",
                props: true,
                name: "Step",
                component: () => import("@/views/StepView.vue"),
                meta: {
                    hideFooter: true
                }
            }
        ]
    },
    {
        path: "/account",
        name: "Account",
        component: () => import("@/views/AccountView.vue"),
        meta: {
            authReq: true
        }
    },
    {
        path: "/login",
        name: "Login",
        component: () => import("@/views/LoginView.vue"),
    },
    {
        path: "/register",
        name: "Register",
        component: () => import("@/views/RegisterView.vue"),
    }
]

const router = new VueRouter({
    mode: 'history',
    base: "/",
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.authReq && userData.user == null) {
        next(`/login?redirect=${to.fullPath}`)
    } else {
        next()
    }
})

export default router
