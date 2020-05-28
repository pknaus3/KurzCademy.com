<template>
	<div class="d-flex flex-column justify-content-center">
		<div class="d-flex flex-row justify-content-center">
			<b-form class="form-block" @submit.prevent="submit">
				<b-form-group id="email-group" label="E-mail" label-for="email">
					<b-form-input
						id="email"
						v-model="login"
						type="text"
						placeholder="Vložte e-mail"
						autocomplete="username"
					></b-form-input>
				</b-form-group>
				<b-form-group id="password-group" label="Heslo" label-for="password">
					<b-form-input
						id="password"
						v-model="password"
						type="password"
						autocomplete="password"
						placeholder="Vložte heslo"
					></b-form-input>
				</b-form-group>
				<div class="form-control error-box" :data-active="error.length > 0">{{ error }}</div>
				<div class="d-flex flex-row mt-3">
					<b-button type="submit" variant="primary">Prihlásiť</b-button>
					<b-spinner variant="primary" class="ml-2 mt-1" v-if="loading"></b-spinner>
				</div>
			</b-form>
		</div>
	</div>
</template>

<style scoped>
	.form-block {
		flex-basis: 700px;
		padding-bottom: 100px;
	}

	.error-box {
		transform: scale(1, 0);
		transition: transform 0.1s;
		border-color: red;
		height: auto;
	}

	.error-box[data-active="true"] {
		transform: scale(1, 1);
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { userData, login } from '../user'

	@Component
	export default class LoginView extends Vue {
		userData = userData
		login = ""
		password = ""
		loading = false
		error = ""

		submit() {
			this.loading = true
			login(this.login, this.password).then(() => {
                this.loading = false
                if (this.$route.query.redirect) {
                    this.$router.push(this.$route.query.redirect as string)
                } else {
                    this.$router.push("/")
                }
			}).catch((err) => {
				this.loading = false
				this.error = Object.values(err.response.data as Record<string, string[]>).map(v => v.join("\n")).join("\n")
				console.error(err, err.response)
			})
		}
	}
</script>