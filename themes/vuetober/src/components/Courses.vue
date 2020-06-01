<template>
	<div>
		<router-link
			:to="`/course/${course.id}`"
			style="text-decoration: none"
			v-for="course in courses"
			:key="course.id"
		>
			<b-card
				:title="course.name"
				:img-src="course.thumbPath"
				img-top
				img-height="50%"
				class="mx-3 course-card d-inline-flex"
				:style="`background-color: ${course.coursecolor}`"
			>
				<b-card-text v-html="course.description"></b-card-text>
			</b-card>
		</router-link>
	</div>
</template>

<style scoped>
	.course-card {
		width: 356px;
		height: 438px;
		color: white;
	}

	.course-card {
		box-shadow: 0 0 0 rgba(0, 0, 0, 0.125);
		transition: box-shadow 0.1s ease-in;
	}

	.course-card:hover {
		box-shadow: 0 0 60px rgba(0, 0, 0, 0.125);
	}

	.course-card > img {
		object-fit: cover;
	}

	.course-card > .card-body > .card-title {
		background-color: white;
		border-radius: 20px;
		padding-top: 6px;
		padding-right: 20px;
		padding-bottom: 6px;
		padding-left: 20px;
		font-size: 16px;
		color: var(--highligh-color);
		font-weight: bold;
		display: inline;
	}

	.course-card > .card-body > .card-text {
		margin-top: 10px;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
    import * as vueProp from "vue-property-decorator"
    import axios from "axios"
    import { ICourse } from '../types'

	@Component
	export default class Courses extends Vue {
		courses = [
		
		] as ICourse[]

		async mounted() {
            let coursesResponse = await axios.get("/api/courses/")
            this.courses = coursesResponse.data
		}
	}
</script>