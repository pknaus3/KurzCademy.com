<template>
	<div>
        <portal-target name="root-pre-body" multiple></portal-target>
		<b-container fluid>
			<b-col>
				<Header></Header>
				<router-view></router-view>
				<Footer v-if="!$router.currentRoute.meta.hideFooter"></Footer>
			</b-col>
		</b-container>  
	</div>
</template>

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
