<template>
	<div v-if="userData.user" class="d-flex flex-column justify-content-center">
		<div class="d-flex flex-row justify-content-center">
			<div class="mr-5 d-flex flex-column">
				<div class="avatar-container">
					<b-btn @click="uploadAvatar()" variant="link">
						<b-avatar size="200px" :src="userData.user.avatar.path"></b-avatar>
					</b-btn>
					<b-btn variant="light" class="trash-btn" @click="delteUserAvatar()" v-if="userData.user.avatar.path">
						<b-icon-trash-fill></b-icon-trash-fill>
					</b-btn>
				</div>
				<input
					type="file"
					accept="image/*"
					ref="imageUpload"
					@change="onAvatarSelect($event)"
					class="d-none"
				/>
			</div>
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
					></b-form-input>
				</b-form-group>
				<b-form-group id="new-password-group" label="Nové heslo" label-for="new-password">
					<b-form-input
						id="new-password"
						v-model="newPassword"
						type="password"
						autocomplete="new-password"
					></b-form-input>
				</b-form-group>
				<b-form-group id="confirm-password-group" label="Overiť heslo" label-for="confirm-password">
					<b-form-input
						id="confirm-password"
						v-model="confirmPassword"
						type="password"
						autocomplete="new-password"
					></b-form-input>
				</b-form-group>
				<div class="form-control error-box" :data-active="error.length > 0">{{ error }}</div>
				<div class="d-flex flex-row mt-3">
					<b-button type="submit" variant="primary">Uložiť</b-button>
					<b-button type="reset" variant="danger" class="ml-2" @click="resetValues()">Reset</b-button>
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

	.avatar-container {
		position: relative;
	}

	.avatar-container > .trash-btn {
		position: absolute;
		top: 0;
		right: -10px;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { userData, updateUserData, updateUserAvatar, deleteAvatar } from '../user'

	@Component
	export default class AccountView extends Vue {
		userData = userData
		fullName = userData.user!.name
		email = userData.user!.email
		newPassword = ""
		confirmPassword = ""
		error = ""
		loading = false

		resetValues() {
			this.fullName = this.userData.user!.name
			this.email = this.userData.user!.email
			this.newPassword = ""
			this.confirmPassword = ""
			this.error = ""
		}

		submit() {
			let newPassword = null as string | null
			if (this.newPassword) {
				if (this.newPassword != this.confirmPassword) {
					this.error = "Nové heslo a overenie hesla sa musia rovnať"
					return
				} else {
					newPassword = this.newPassword
				}
			}

			let fullName = this.fullName || this.userData.user!.name
			let email = this.email || this.userData.user!.email

			this.loading = true
			updateUserData(fullName, email, newPassword).then(() => {
				this.loading = false
				this.resetValues()
			}).catch((err) => {
				this.loading = false
				this.error = Object.values(err.response.data as Record<string, string[]>).map(v => v.join("\n")).join("\n")
				console.error(err, err.response)
			})
        }
        
        uploadAvatar() {
            (this.$refs.imageUpload as HTMLInputElement).click()
        }

        onAvatarSelect(event: Event) {
            let file = (event?.target as HTMLInputElement)?.files?.[0] as File | null
            if (file != null) updateUserAvatar(file)
        }

        delteUserAvatar() {
            deleteAvatar()
        }
	}
</script>