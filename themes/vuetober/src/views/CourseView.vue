<template>
	<div id="viewer" class="viewer">
		<template v-if="course">
			<div class="viewer-head">
				<div class="course-name">{{ course.name }}</div>
			</div>
			<div class="viewer-body">
				<div class="viewer-steps">
					<div class="viewer-step" v-for="(step, index) in steps" :key="step.id">
						<button
							v-text="(index + 1) + '. ' + step.step_name"
							@click="selectStep(step)"
							class="viewer-step-name"
							:disabled="step.id.toString() == currStep"
						></button>
					</div>
				</div>
				<div class="viewer-main">
					<div v-if="currStep">
						<router-view :prevStep="this.currStepIndex > 0" :nextStep="this.currStepIndex < this.steps.length - 1" @prev="stepOffset(-1)" @next="stepOffset(1)"></router-view>
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
		flex: 1 1;
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

	.viewer-step > :disabled {
		opacity: 0.5;
	}

	.viewer-step-name {
		flex: 1 1;
		text-align: left;
	}

	.viewer-step-name:disabled {
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
	import { ICourse, IStep, getCourseById, getCourseStepsById } from '../courses'

	@Component
	export default class CourseView extends Vue {
		@vueProp.Prop({ type: String, required: true })
		readonly id!: string
		course = null as ICourse | null
		steps = [] as IStep[]

		async mounted() {
			this.course = await getCourseById(this.id)

			this.reloadCourses()
		}

		async reloadCourses() {
			if (this.course != null) {
				this.steps = (await getCourseStepsById(this.id)).sort((a, b) => a.step_position - b.step_position)

				if (this.steps.length > 0 && this.currStep == null) this.$router.replace({ name: "Step", params: { stepId: this.steps[0].id.toString() } })
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
			if (stepId != null) this.$router.push({ name: "Step", params: { stepId: stepId } })
			else this.$router.push({ name: "Course", params: { id: this.id } })
		}

		stepOffset(offset: number) {
			this.currStep = this.steps[this.currStepIndex + offset].id.toString()
        }
        
        get currStepIndex() {
            return this.steps.findIndex(v => v.id.toString() == this.currStep)
        }
	}
</script>