<template>
    <Courses class="courses"></Courses>
</template>

<style scoped>
    .courses {
        min-height: calc(100vh - 150px);
    }
</style>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component"
import * as vueProp from "vue-property-decorator"

@Component({
    components: {
        Courses: () => import("@/components/Courses.vue")
    }
})
export default class CoursesView extends Vue {
   
}
</script>