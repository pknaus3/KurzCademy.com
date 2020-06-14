<template>
	<div id="viewer" class="viewer">
		<template v-if="course">
			<div class="viewer-head">
				<div class="course-name">{{ course.name }}</div>
				<b-btn
					variant="outline-dark"
					class="border-0"
					@click="isCourseFavourited = !isCourseFavourited"
					v-if="userData.user != null"
				>
					<b-icon :icon="isCourseFavourited ? 'star-fill' : 'star'"></b-icon>
				</b-btn>
			</div>
			<div class="viewer-body">
				<div class="viewer-steps">
					<div class="viewer-step" v-for="(step, index) in steps" :key="step.id">
						<button
							@click="selectStep(step)"
							class="viewer-step-name"
							:data-active="step.id.toString() == currStep"
						>
							<div data-v-5f358b1a class="custom-control custom-checkbox">
								<input
									type="checkbox"
									autocomplete="off"
									class="custom-control-input"
									value="true"
									:id="`C_${index}`"
									v-model="stepsChecked[index]"
									@change.capture.stop.prevent="setStepChecked(step, $event.target.checked)"
								/>
								<label class="custom-control-label" :for="`C_${index}`"></label>
							</div>
							<span>{{ step.step_name }}</span>
						</button>
					</div>
				</div>
				<div class="viewer-main">
					<div v-if="currStep">
						<router-view
							:prevStep="this.currStepIndex > 0"
							:nextStep="this.currStepIndex < this.steps.length - 1"
							@prev="stepOffset(-1)"
							@next="stepOffset(1)"
						></router-view>
					</div>
					<div v-else>
						<div class="viewer-no-step">
							<h3>Zvoľte krok na zobrazenie</h3>
						</div>
					</div>
				</div>
			</div>
		</template>
		<div v-else class="viewer-course-not-found">
			<h3>
				Kurz nebol nájdený
				<br />
			</h3>
			<b-btn variant="primary" class="mt-2" to="/courses">Naspäť</b-btn>
		</div>
	</div>
</template>

<style scoped>
	.viewer {
		height: calc(100vh - 76px);
		display: flex;
		flex-direction: column;
	}

	.viewer-head {
		flex: 0 0 47px;
		display: flex;
		flex-direction: row;
		border-bottom: 1px solid #dedfe3;
		padding: 4px;
		padding-right: 0;
	}

	.viewer-head > * {
		margin-right: 4px;
	}

	.viewer-head > button {
		margin-top: 6px;
		margin-bottom: 6px;
	}

	.course-name {
		border: none;
		font-size: 35px;
	}

	.viewer-body {
		flex: 1 1;
		display: flex;
		flex-direction: row;
		height: calc(100% - 70px);
	}

	.viewer-steps {
		overflow: hidden;
		overflow-y: scroll;
		border-right: 1px solid #dedfe3;
		min-width: 200px;
	}

	.viewer-step {
		display: flex;
		flex-direction: row;
		height: 49px;
		padding: 4px;
	}

	.viewer-step > * {
		background-color: white;
		border: 2px solid #dedfe3;
		border-radius: 4px;
		color: #5f5b78;
	}

	.viewer-step > [data-active="true"] {
		opacity: 0.5;
	}

	.viewer-step-name {
		flex: 1 1;
		text-align: left;
	}

	.viewer-step-name > div {
		display: inline-block;
	}

	.viewer-step-name[data-active="true"] {
		opacity: 1;
		background-color: #e9e4ff;
		border-color: #575eed;
		color: #5f5b78;
	}

	.viewer-main {
		flex: 1 1;
		position: relative;
	}

	.viewer-iframe {
		height: 100%;
	}

	.viewer-loading {
		position: absolute;
		top: 50%;
		left: 50%;
	}

	.viewer-no-step {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		text-align: center;
		padding-top: 100px;
	}

	.viewer-main > div {
		height: 100%;
		display: flex;
		flex-direction: column;
	}

	.viewer-course-not-found {
		flex: 1 1;
		text-align: center;
		padding-top: 25vh;
	}

	.void-sides {
		padding: 0 !important;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { ICourse, IStep, getCourseById, getCourseStepsById, getCourseFavourite, setCourseFavourite, getStepChecked, setStepChecked } from '../courses'
	import { userData } from '../user'

	@Component
	export default class CourseView extends Vue {
		@vueProp.Prop({ type: String, required: true })
		readonly id!: string
		course = null as ICourse | null
		steps = [] as IStep[]
		stepsChecked = [] as boolean[]
		isCourseFavourited = false
		userData = userData

		async mounted() {
			this.course = await getCourseById(this.id)

			this.reloadCourses()
		}

		async reloadCourses() {
			if (this.course != null) {
				await Promise.all([
					(async () => {
						this.steps = (await getCourseStepsById(this.id)).sort((a, b) => a.step_position - b.step_position)

						if (this.steps.length > 0 && this.currStep == null) this.$router.replace({ name: "Step", params: { stepId: this.steps[0].id.toString() } })
					})(),
					(async () => {
						if (userData.user != null) this.isCourseFavourited = await getCourseFavourite(this.id)
					})()
				])
			}
		}

		selectStep(step: IStep) {
			this.currStep = step.id.toString()
		}

		// @vueProp.Watch("currStep")
		// onCurrStepChange() {
		//     if (this.currStep) this.$router.push(`/course/${this.id}/${this.currStep.id}`)
		// }

		get currStep(): string | null {
			return this.$route.params.stepId
		}


		set currStep(stepId: string | null) {
			if (stepId == this.$route.params.stepId) return
			if (stepId != null) this.$router.push({ name: "Step", params: { stepId: stepId } })
			else this.$router.push({ name: "Course", params: { id: this.id } })
		}

		stepOffset(offset: number) {
			this.currStep = this.steps[this.currStepIndex + offset].id.toString()
		}

		get currStepIndex() {
			return this.steps.findIndex(v => v.id.toString() == this.currStep)
		}

		@vueProp.Watch("isCourseFavourited")
		async onFavouriteChanged() {
			await setCourseFavourite(this.id, this.isCourseFavourited)
		}

		@vueProp.Watch("steps")
		onStepsChanged() {
			this.stepsChecked = Array(this.steps.length).fill(false)
			this.steps.forEach(async (v, i) => {
				this.stepsChecked[i] = await getStepChecked(v.id.toString())
			})
		}

		setStepChecked(step: IStep, checked: boolean) {
			setStepChecked(step.id.toString(), checked)
		}
	}
</script>