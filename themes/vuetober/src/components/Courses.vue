<template>
	<div>
		<router-link
			:to="`/course/${course.id}`"
			style="text-decoration: none"
			v-for="(course, index) in courses"
			:key="course.id"
		>
			<b-card
				:title="course.name"
				:img-src="course.thumbPath"
				img-top
				img-height="50%"
				class="course-card d-inline-flex m-3"
				:style="`background-color: ${course.coursecolor}`"
			>
				<b-card-text v-html="course.description"></b-card-text>
				<b-icon
					v-if="userData.user != null && !favouriteOnly && favourites.length > 0"
					class="course-favourite"
					font-scale="1.5"
					:icon="favourites[index] ? 'star-fill' : 'star'"
				></b-icon>
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

	.course-favourite {
		position: absolute;
		top: 5px;
		right: 5px;
		stroke: black;
		stroke-width: 0.25px;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { ICourse, getAllCourses, getCourseFavourite, getAllFavouritedCourses } from '../courses'
	import { userData } from '../user'

	@Component
	export default class Courses extends Vue {
		@vueProp.Prop({ type: Boolean, required: false, default: false })
		readonly favouriteOnly!: boolean
		@vueProp.Prop({ type: Number, default: -1 })
		readonly max!: number

		courses = [] as ICourse[]
		favourites = [] as boolean[]
		userData = userData

		@vueProp.Watch("favouriteOnly", { immediate: true })
		async onFavouriteOnlyChanged() {
			if (this.favouriteOnly) {
				if (userData.user != null) {
					this.courses = await getAllFavouritedCourses()
				} else {
					this.courses = []
				}
			} else {
				this.courses = await getAllCourses(this.max)
				if (userData.user != null) {
					this.favourites = await Promise.all(this.courses.map(async v => {
						return getCourseFavourite(v.id.toString())
					}))
				} else {
					this.favourites = []
				}
			}
		}
	}
</script>