<template>
	<div>
        <portal-target name="root-pre-body" multiple></portal-target>
		<b-container fluid>
			<b-col>
				<Header></Header>
				<router-view class="main"></router-view>
				<Footer v-if="!$router.currentRoute.meta.hideFooter"></Footer>
			</b-col>
		</b-container>  
	</div>
</template>

<style scoped>
.main {
    min-height: calc(100vh - 150px);
}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
    import * as vueProp from "vue-property-decorator"
    import "@/assets/master.css"

	@Component({
		components: {
			Header: () => import("@/components/Header.vue"),
			Footer: () => import("@/components/Footer.vue")
		}
	})
	export default class App extends Vue {

	}
</script>
