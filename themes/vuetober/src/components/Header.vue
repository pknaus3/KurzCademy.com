<template>
	<b-navbar>
		<!-- Logo -->
		<b-navbar-brand to="/">
			<b-img src="@/assets/img/logo/KurzCademyLogoBezTextu.png" height="50px"></b-img>
		</b-navbar-brand>
		<!-- Navigation -->
		<b-btn variant="outline-secondary" class="navlink bg-white" to="/courses">Kurzy</b-btn>
		<b-btn
			variant="outline-secondary"
			class="navlink ml-2 bg-white"
			to="/favourites"
			v-if="userData.user != null"
		>Obľúbené</b-btn>
		<!-- Spacer -->
		<div class="flex-fill"></div>
		<!-- User menus -->
		<b-btn
			v-if="userData.user"
			variant="outline-dark"
			class="d-flex flex-row align-items-center user-button"
		>
			<b-avatar :src="userData.user.avatar.path"></b-avatar>
			<div class="ml-2">{{ userData.user.name }}</div>
			<div class="d-flex user-menu flex-column border border-top-0">
				<b-btn variant="light" to="/account">Môj účet</b-btn>
				<b-btn variant="light" @click="logout()">Odhlásiť</b-btn>
			</div>
		</b-btn>
		<!-- Login and register -->
		<template v-else>
			<b-btn variant="outline-dark" :to="makeRedirectPath(`/login`)" class="user-button">Prihlásiť</b-btn>
			<b-btn
				variant="outline-dark"
				:to="makeRedirectPath(`/register`)"
				class="user-button ml-2"
			>Registrovať</b-btn>
		</template>
	</b-navbar>
</template>

<style scoped>
	.user-button {
		position: relative;
		border: none;
		font-weight: bold;
		z-index: 2;
	}

	.user-menu {
		visibility: collapse;
		opacity: 0;
		position: absolute;
		top: calc(100% - 4px);
		left: 0;
		background-color: white;
		width: 100%;
		border-radius: 4px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		transform: translate(0, -50%) scale(1, 0);
		transition: opacity 0.15s, transform 0.15s, visibility 0.15s;
	}

	.user-menu > * {
		text-align: left;
	}

	.user-button:hover > .user-menu {
		visibility: visible;
		opacity: 1;
		transform: translate(0, 0) scale(1, 1);
	}

	.navlink.router-link-exact-active {
		font-weight: bold;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { userData, logout } from "../user"
	import { RawLocation } from 'vue-router'

	@Component
	export default class Header extends Vue {
		userData = userData

		logout() {
			logout()
		}

		makeRedirectPath(to: string) {
			return {
				path: to,
				query: { redirect: this.$route.query.redirect ?? this.$route.fullPath }
			} as RawLocation
		}
	}
</script>