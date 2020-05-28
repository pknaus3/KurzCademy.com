<template>
	<div class="step-viewer">
		<div class="step-container" id="stepContainer">
			<template v-if="step">
				<div id="why">
					<h2 class="mt-2 mb-3" id="header">{{ step.step_name }}</h2>
					<div v-html="step.why"></div>
				</div>
				<div id="guide">
					<iframe
						v-if="step.video_link"
						:src="`https://www.youtube.com/embed/${step.video_link}`"
						class="video mb-3"
						id="video"
						frameborder="0"
						allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
					></iframe>
					<iframe
						v-if="step.custom_text"
						class="document"
						id="customText"
						style="height: 0;"
						frameborder="0"
						allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
						ref="customTextIframe"
					></iframe>
					<iframe
						v-if="step.docs_link"
						src
						class="document"
						id="document"
						style="height: 0;"
						frameborder="0"
						allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
						ref="docsIframe"
					></iframe>
				</div>
				<div id="faq">
					<div v-if="step.homework" id="homework"></div>
				</div>

				<div class="go-buttons">
					<a class="btn btn-outline-secondary" id="prev" v-if="prevStep" @click="$emit('prev')">◁ Späť</a>
					<a class="btn btn-outline-secondary" id="next" v-if="nextStep" @click="$emit('next')">Ďalej ▷</a>
				</div>
			</template>
		</div>

		<b-nav class="navigation" v-b-scrollspy:stepContainer.50>
			<b-nav-item href="#why">Why</b-nav-item>
			<b-nav-item href="#guide">Guide</b-nav-item>
			<b-nav-item href="#faq">Why</b-nav-item>
		</b-nav>
	</div>
</template>

<style scoped>
	.error-div {
		position: absolute;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		text-align: center;
		line-height: 100vh;
		vertical-align: middle;
	}

	.step-viewer {
		margin: 0;
		height: 100%;
	}

	.step-container {
		position: relative;
		padding: calc(50% - 450px);
		padding-top: 4px;
		padding-bottom: 10px;
		height: 100%;
		overflow-y: scroll;
		margin: 0;
		background-color: white;
	}

	.video {
		width: calc(100% - 10px);
		max-width: 100%;
		height: calc(800px * 0.5625);
	}

	.document {
		width: calc(100% - 10px);
	}

	.go-buttons {
		display: flex;
		flex-direction: row;
		justify-content: center;
	}

	.go-buttons > * {
		margin-left: 4px;
	}
	.navigation {
		position: absolute;
		top: 10px;
		left: 10px;
	}

	.navigation {
		display: flex;
		flex-direction: column;
	}

	.navigation > * {
		display: block;
		margin-bottom: 10px;
	}

	.navigation > * > * {
		display: block;
		width: 100%;
		padding-right: 4px;
		border-right: 2px solid lightgrey;
	}

	.navigation > * > .active {
		border-right: 2px solid var(--primary);
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { IStep } from '../types'
	import axios from "axios"
	// @ts-ignore
	import markdownit from "markdown-it"
	// @ts-ignore
	import hljs from "highlight.js"

	@Component
	export default class StepView extends Vue {
		@vueProp.Prop({ type: String, required: true })
		readonly stepId!: string
		@vueProp.Prop({ type: Boolean, required: true })
		readonly prevStep!: boolean
		@vueProp.Prop({ type: Boolean, required: true })
		readonly nextStep!: boolean
		step = null as IStep | null
		intervalId = -1

		mounted() {
			this.reloadStep()
			this.intervalId = setInterval(() => {
				if (this.$refs.customTextIframe) this.documentResize(this.$refs.customTextIframe as HTMLIFrameElement)
				if (this.$refs.docsIframe) this.documentResize(this.$refs.docsIframe as HTMLIFrameElement)
			}, 100)
		}

		destroy() {
			clearInterval(this.intervalId)
		}

		documentResize(iframe: HTMLIFrameElement) {
			iframe.style.height = `${iframe.contentDocument!.documentElement.scrollHeight}px`
		}

		async reloadStep() {
			let stepResponse = await axios.get<IStep>(`/api/step/${this.stepId}`)
			this.step = stepResponse.data

			this.$nextTick(() => {
				if (this.step) {
					if (this.step.custom_text) {
						let customTextIframe = this.$refs.customTextIframe as HTMLIFrameElement
						let code = this.step.custom_text
						customTextIframe.contentDocument!.body.innerHTML = code + `
                            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/styles/github-gist.min.css">
                            <style>
                                body {
                                    margin: 0 !important;
                                }

                                pre {
                                    padding: 10px;
                                    background-color: #f6f8fa;
                                }

                                code {
                                    background-color: #f6f8fa;
                                    color: initial;
                                    padding: .2em .4em;
                                }

                                pre > code {
                                    padding: 0;
                                }
                            </style>
                        `
						if (customTextIframe!.contentDocument!.body!.firstChild!.nodeName == "PRE") {
							let preElement = customTextIframe!.contentDocument!.body!.firstChild! as HTMLPreElement
							let output = markdownit({
								highlight: function (str: string, lang: string) {
									if (lang && hljs.getLanguage(lang)) {
										try {
											return hljs.highlight(lang, str).value;
										} catch {

										}
									}

									return ''
								}
							}).render(preElement.innerText)
							preElement.outerHTML = output
						}
						this.$nextTick(() => {
							this.documentResize(customTextIframe)
						})
					}
					if (this.step.docs_link) {
						let docsIframe = this.$refs.docsIframe as HTMLIFrameElement
						let code = this.step.renderedDocsHtml
						docsIframe.contentDocument!.body.innerHTML = code
						this.documentResize(docsIframe)
					}
				}
			})
		}

		@vueProp.Watch("stepId")
		onStepIdChanged() {
			this.step = null
			this.reloadStep()
		}
	}
</script>