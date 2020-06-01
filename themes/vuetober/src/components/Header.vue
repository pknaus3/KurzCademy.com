<template>
	<b-navbar>
        <!-- Logo -->
		<b-navbar-brand to="/">
			<b-img src="@/assets/img/logo/KurzCademyLogoBezTextu.png" height="50px"></b-img>
		</b-navbar-brand>
        <!-- Navigation -->
        <b-btn variant="light" class="navlink" to="/courses">Kurzy</b-btn>
        <b-btn variant="light" class="navlink ml-2" to="/favourites">Obľúbené</b-btn>
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
			<div class="d-flex user-menu flex-column">
				<b-btn variant="light" to="/account">Môj účet</b-btn>
				<b-btn variant="light" @click="logout()">Odhlásiť</b-btn>
			</div>
		</b-btn>
        <!-- Login and register -->
		<template v-else>
			<b-btn variant="outline-dark" :to="{ path: '/login', query: { redirect: $route.fullPath } }" class="user-button">Prihlásiť</b-btn>
			<b-btn variant="outline-dark" :to="{ path: '/register', query: { redirect: $route.fullPath } }" class="user-button ml-2">Registrovať</b-btn>
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
	}

	.user-menu > * {
		text-align: left;
	}

	.user-button:hover > .user-menu {
        visibility: visible;
		opacity: 1;
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

	@Component
	export default class Header extends Vue {
		userData = userData

		logout() {
			logout()
		}
	}
</script>