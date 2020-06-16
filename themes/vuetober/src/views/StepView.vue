<template>
	<div class="step-viewer">
		<div class="step-container" id="stepContainer">
			<template v-if="step">
				<div class="step-main">
					<div id="why">
						<h2 class="mt-2 mb-3" id="header">{{ step.step_name }}</h2>
						<div v-html="step.why"></div>
					</div>
					<div id="guide">
						<!-- Video -->
						<div class="videos-top">
							<iframe
								v-if="currVideoURL"
								:src="`https://www.youtube.com/embed/${currVideoURL}`"
								class="video mb-3"
								id="video"
								frameborder="0"
								allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen
							></iframe>
							<div class="videos-container">
								<div v-for="video in videos" :key="video.id">
									<img
										:src="`https://img.youtube.com/vi/${video.link}/sddefault.jpg`"
										class="extra-video"
										@click="currVideoURL = video.link"
									/>
								</div>
							</div>
						</div>
						<!-- Custom text -->
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
						<!-- Document -->
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
				</div>

				<div class="go-buttons">
					<b-btn variant="outline-dark" class="border-0" :disabled="!prevStep" @click="$emit('prev')">
						<b-icon-chevron-left scale="0.75"></b-icon-chevron-left>
						<span>Späť</span>
					</b-btn>
					<b-btn variant="outline-dark" class="border-0" :disabled="!nextStep" @click="$emit('next')">
						<span>Ďalej</span>
						<b-icon-chevron-right scale="0.75"></b-icon-chevron-right>
					</b-btn>
				</div>

				<div class="d-flex flex-column m-2 border-top pt-2">
					<template v-if="userData.user != null">
						<!-- Comment box  -->
						<b-form-textarea
							v-model="commentContent"
							placeholder="Vložte komentár"
							rows="3"
							max-rows="6"
							@keydown="onCommentKeyDown($event)"
						></b-form-textarea>
						<!-- Controlls -->
						<div class="mt-2 d-flex flex-row">
							<!-- Send button -->
							<b-btn variant="primary" @click="sendComment()">Odoslať</b-btn>
							<!-- Waiting indicator -->
							<b-spinner variant="primary" class="ml-2 mt-1" v-if="waitingComment"></b-spinner>
						</div>
					</template>
					<template v-else>
						<!-- Comment box if not signed in -->
						<div class="d-flex flex-row">
							<!-- Please login message -->
							<div class="d-flex flex-column justify-content-center">Na písanie komentárov sa musíte</div>
							<b-btn
								variant="primary"
								class="ml-2"
								:to="{ path: '/login', query: { redirect: $route.fullPath } }"
							>Prihlásiť</b-btn>
							<!-- Spacer -->
							<div class="flex-fill"></div>
						</div>
					</template>
				</div>

				<!-- Comments container -->
				<div class="written-comments border-top">
					<div class="mt-1 ml-3">{{ commentCountText }}</div>
					<!-- Comment -->
					<div
						v-for="comment in comments"
						:key="comment.id"
						class="border rounded d-flex flex-column p-2 m-2"
					>
						<!-- Header -->
						<div class="d-flex flex-row">
							<!-- Avatar -->
							<b-avatar size="25px" :src="comment.user.avatar.path"></b-avatar>
							<!-- User name -->
							<div class="font-weight-bold ml-2">{{ comment.user.name }}</div>
							<!-- Spacer -->
							<div class="flex-fill"></div>
							<!-- Delete button -->
							<b-btn
								variant="outline-dark p-1 px-2"
								class="border-0"
								v-if="comment.isOwner"
								@click="deleteComment(comment.id)"
							>
								<b-icon icon="trash-fill" font-scale="0.99"></b-icon>
							</b-btn>
						</div>
						<!-- Comment text -->
						<div class="mt-2" style="white-space: pre">{{ comment.comment }}</div>
					</div>
				</div>
			</template>
		</div>

		<b-nav class="navigation" v-b-scrollspy:stepContainer.50>
			<b-nav-item href="#why">Why</b-nav-item>
			<b-nav-item href="#guide">Guide</b-nav-item>
			<b-nav-item href="#faq">FAQ</b-nav-item>
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

	.videos-top {
		position: relative;
	}

	.videos-container {
		position: absolute;
		top: 0;
		left: 100%;
		height: 100%;
		width: 100px;
	}

	.extra-video {
		margin: 4px;
		height: 140px;
		width: 248px;
		object-fit: cover;
		transform: scale(1);
		transition: transform 0.1s ease-in-out;
	}

	.extra-video:hover {
		transform: scale(1.1);
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

	.step-main {
		min-height: calc(100% - 50px);
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { IStep, getStepById, createComment, IComment, getAllStepComments, deleteComment, IStepVideo, getStepVideos } from '../courses'
	// @ts-ignore
	import markdownit from "markdown-it"
	// @ts-ignore
	import hljs from "highlight.js"
	import { userData } from '../user'

	let boostrapCSS = ""

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
		commentContent = ""
		comments = [] as IComment[]
		waitingComment = false
		userData = userData
		videos = [] as IStepVideo[]
		currVideoURL = ""

		mounted() {
			this.reloadStep()
			this.reloadComments()
			this.reloadVideos()
			this.intervalId = setInterval(() => {
				if (this.$refs.customTextIframe) this.documentResize(this.$refs.customTextIframe as HTMLIFrameElement)
				if (this.$refs.docsIframe) this.documentResize(this.$refs.docsIframe as HTMLIFrameElement)
			}, 100)

			if (!boostrapCSS) boostrapCSS = (document.querySelector(`head > style[type="text/css"]`) as HTMLStyleElement).innerText
		}

		destroy() {
			clearInterval(this.intervalId)
		}

		documentResize(iframe: HTMLIFrameElement) {
			iframe.style.height = `${iframe.contentDocument!.documentElement.scrollHeight}px`
		}

		async reloadStep() {
			this.currVideoURL = ""
			this.step = await getStepById(this.stepId)

			if (this.step) {
				this.currVideoURL = this.step.video_link
			}

			this.$nextTick(() => {
				if (this.step) {
					if (this.step.custom_text) {
						let customTextIframe = this.$refs.customTextIframe as HTMLIFrameElement
						let code = this.step.custom_text
						customTextIframe.contentDocument!.body.innerHTML = code + `
                            <style>${boostrapCSS}</style>
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

                                    .hljs {
                                    display: block;
                                    background: #fff;
                                    padding: .5em;
                                    color: #333;
                                    overflow-x: auto
                                }

                                .hljs-comment,
                                .hljs-meta {
                                    color: #969896
                                }

                                .hljs-emphasis,
                                .hljs-quote,
                                .hljs-strong,
                                .hljs-template-variable,
                                .hljs-variable {
                                    color: #df5000
                                }

                                .hljs-keyword,
                                .hljs-selector-tag,
                                .hljs-type {
                                    color: #d73a49
                                }

                                .hljs-attribute,
                                .hljs-bullet,
                                .hljs-literal,
                                .hljs-symbol {
                                    color: #0086b3
                                }

                                .hljs-name,
                                .hljs-section {
                                    color: #63a35c
                                }

                                .hljs-tag {
                                    color: #333
                                }

                                .hljs-attr,
                                .hljs-selector-attr,
                                .hljs-selector-class,
                                .hljs-selector-id,
                                .hljs-selector-pseudo,
                                .hljs-title {
                                    color: #6f42c1
                                }

                                .hljs-addition {
                                    color: #55a532;
                                    background-color: #eaffea
                                }

                                .hljs-deletion {
                                    color: #bd2c00;
                                    background-color: #ffecec
                                }

                                .hljs-link {
                                    text-decoration: underline
                                }

                                .hljs-number {
                                    color: #005cc5
                                }

                                .hljs-string {
                                    color: #032f62
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

		async reloadComments() {
			this.comments = await getAllStepComments(this.stepId)
			this.comments.forEach(v => {
				if (v.user.avatar == null) {
					v.user.avatar = { path: "" }
				}
			})
		}

		async reloadVideos() {
			this.videos = await getStepVideos(this.stepId.toString())
		}

		@vueProp.Watch("stepId")
		onStepIdChanged() {
			this.step = null
			this.videos = []
			this.reloadStep()
			this.reloadComments()
			this.reloadVideos()
		}

		sendComment() {
			this.waitingComment = true
			createComment(this.stepId, this.commentContent).then(async () => {
				await this.reloadComments()
				this.waitingComment = false
			}).catch(() => {
				this.waitingComment = false
			})
			this.commentContent = ""
		}

		deleteComment(id: string) {
			this.waitingComment = true
			deleteComment(id).then(async () => {
				await this.reloadComments()
				this.waitingComment = false
			}).catch(() => {
				this.waitingComment = false
			})
		}

		onCommentKeyDown(event: KeyboardEvent) {
			if (event.code == "Enter" && !event.shiftKey) {
				event.preventDefault()
				this.sendComment()
			}
		}

		get commentCountText() {
			let commentCount = this.comments.length
			if (commentCount == 0) {
				return "Žiadne komentáre"
			} else if (commentCount < 2) {
				return `${commentCount} komentár`
			} else if (commentCount < 5) {
				return `${commentCount} komentáre`
			} else {
				return `${commentCount} komentárov`
			}
		}
	}
</script>