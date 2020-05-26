import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Home from '../views/Home.vue'

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
        component: () => import("@/views/CoursesView.vue")
    }
]

const router = new VueRouter({
    mode: 'history',
    base: "/",
    routes
})

export default router
