<template>
	<div class="d-flex flex-column justify-content-center">
		<div class="d-flex flex-row justify-content-center">
			<b-form class="form-block" @submit.prevent="submit">
				<b-form-group id="full-name-group" label="Celé meno" label-for="full-name">
					<b-form-input id="full-name" v-model="fullName" type="text" placeholder="Vložte celé meno"></b-form-input>
				</b-form-group>
				<b-form-group id="email-group" label="E-mail" label-for="email">
					<b-form-input
						id="email"
						v-model="email"
						type="text"
						placeholder="Vložte e-mail"
						autocomplete="username"
                        required
					></b-form-input>
				</b-form-group>
				<b-form-group id="new-password-group" label="Nové heslo" label-for="new-password">
					<b-form-input
						id="new-password"
						v-model="newPassword"
						type="password"
						autocomplete="new-password"
                        required
					></b-form-input>
				</b-form-group>
				<b-form-group id="confirm-password-group" label="Overiť heslo" label-for="confirm-password">
					<b-form-input
						id="confirm-password"
						v-model="confirmPassword"
						type="password"
						autocomplete="new-password"
                        required
					></b-form-input>
				</b-form-group>
				<div class="form-control error-box" :data-active="error.length > 0">{{ error }}</div>
				<div class="d-flex flex-row mt-3">
					<b-button type="submit" variant="primary">Uložiť</b-button>
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
	import { userData, updateUserData, updateUserAvatar, deleteAvatar, registerUser } from '../user'

	@Component
	export default class AccountView extends Vue {
		fullName = ""
		email = ""
		newPassword = ""
		confirmPassword = ""
		error = ""
		loading = false

		submit() {
            let newPassword = this.newPassword
            
				if (this.newPassword != this.confirmPassword) {
					this.error = "Nové heslo a overenie hesla sa musia rovnať"
					return
				}

			let fullName = this.fullName
			let email = this.email

			this.loading = true
			registerUser(fullName, email, newPassword).then(() => {
				this.loading = false
				if (this.$route.query.redirect) {
                    this.$router.push(this.$route.query.redirect as string)
                } else {
                    this.$router.push("/")
                }
			}).catch((err: any) => {
				this.loading = false
				this.error = Object.values(err.response.data as Record<string, string[]>).map(v => v.join("\n")).join("\n")
				console.error(err, err.response)
			})
        }
	}
</script>