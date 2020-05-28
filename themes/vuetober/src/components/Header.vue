<template>
	<b-navbar>
		<b-navbar-brand to="/">
			<b-img src="@/assets/img/logo/KurzCademyLogoBezTextu.png" height="50px"></b-img>
		</b-navbar-brand>
		<div class="flex-fill"></div>
		<b-btn v-if="userData.user" variant="outline-dark" class="d-flex flex-row align-items-center user-button" style="border: none">
			<b-avatar :src="userData.user.avatar.path"></b-avatar>
            <div class="font-weight-bold ml-2">{{ userData.user.name }}</div>
            <div class="user-menu flex-column">
                <b-btn variant="light" to="/account">Môj účet</b-btn>
                <b-btn variant="light" @click="logout()">Odhlásiť</b-btn>
            </div>
		</b-btn>
	</b-navbar>
</template>

<style scoped>
    .user-button {
        position: relative;
    }

    .user-menu {
        display: none;
        opacity: 0;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        width: 100%;
    }

    .user-menu > * {
        text-align: left;
    }

    .user-button:hover > .user-menu {
        display: flex;
        opacity: 1;
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