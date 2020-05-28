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
        component: () => import("@/components/Courses.vue")
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
    }
]

const router = new VueRouter({
    mode: 'history',
    base: "/",
    routes
})

export default router
