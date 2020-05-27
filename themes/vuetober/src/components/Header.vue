<template>
	<b-navbar>
		<b-navbar-brand to="/">
			<b-img src="@/assets/img/logo/KurzCademyLogoBezTextu.png" height="50px"></b-img>
		</b-navbar-brand>
		<div class="flex-fill"></div>
		<template v-if="userData.user">
			<b-avatar variant="light" :src="userData.user.avatar"></b-avatar>
            <div class="font-weight-bold ml-2">{{ userData.user.name }}</div>
		</template>
	</b-navbar>
</template>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"
	import { userData } from "../user"

	@Component
	export default class Header extends Vue {
		userData = userData
	}
</script>