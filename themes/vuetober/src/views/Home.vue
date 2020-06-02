<template>
	<b-col>
		<!-- Main Image -->
		<portal to="root-pre-body">
			<b-img src="@/assets/img/otherLogos/mainpage-1.png" class="main-image"></b-img>
		</portal>
		<!-- Main Text -->
		<b-row style="height: calc(100vh - 150px)">
			<b-col cols="6" class="d-flex flex-column justify-content-center">
				<div class="d-flex flex-row justify-content-center">
					<div class="highlight-text">
						<p>Všetko ON-LINE</p>
						<h2 class="font-weight-bold">Vzdelanie ktoré ti zmení život</h2>
						<div class="mt-3">Vyber si oblasť, v ktorej sa chceš vzdelávať.</div>
						<div>Naše kurzy ťa prevedú od úplných základov až po pokročilejšie techniky.</div>
						<b-btn class="mt-3" variant="primary" to="courses">Všetky Kurzy</b-btn>
						<div class="mt-3">Aké technológie sa tu naučíte?</div>
						<div class="mt-1">
							<b-img height="50px" class="ml-2" src="@/assets/img/otherLogos/ionic-logo.png"></b-img>
							<b-img height="50px" class="ml-2" src="@/assets/img/otherLogos/un-js-logo.png"></b-img>
							<b-img height="50px" class="ml-2" src="@/assets/img/otherLogos/react-logo.png"></b-img>
							<b-img height="50px" class="ml-2" src="@/assets/img/otherLogos/vue-logo.png"></b-img>
							<b-img height="50px" class="ml-2" src="@/assets/img/otherLogos/angular-logo.png"></b-img>
						</div>
					</div>
				</div>
			</b-col>
		</b-row>
		<!-- Fičurky -->
		<b-col class="highlight-text">
			<b-col cols="6">
				<h1 class="ml-3">
					V našich kurzoch učíme ľudí
					<b>programovať webstránky a mobilné aplikácie</b>
				</h1>
			</b-col>
			<b-row class="d-flex flex-row justify-content-around mt-5">
				<div class="feature">
					<b-img class="feature-image" src="@/assets/img/topficurky/ficurka-2.png"></b-img>
					<h1 class="font-weight-bold mt-3">Vzdelávaj sa</h1>
					<div
						class="mt-3"
					>Vyber si oblasť, v ktorej sa chceš vzdelávať. Naše kurzy ťa prevedú od úplných základov až po pokročilejšie techniky.</div>
				</div>
				<div class="feature">
					<b-img class="feature-image" src="@/assets/img/topficurky/ficurka-1.png"></b-img>
					<h1 class="font-weight-bold mt-3">Pýtaj sa</h1>
					<div class="mt-3">V kľude nám môžeš napísať a opýtať sa dodatočné info.</div>
				</div>
				<div class="feature">
					<b-img class="feature-image" src="@/assets/img/topficurky/ficurka-3.png"></b-img>
					<h1 class="font-weight-bold mt-3">Máš nápad?</h1>
					<div class="mt-3">Máš nápad? Naše kurzy ti ho pomôžu zrealizovať.</div>
				</div>
			</b-row>
		</b-col>
		<!-- Kurzy -->
		<b-col class="highlight-text mb-5">
			<h1 class="font-weight-bold ml-3">Naše kurzy</h1>
			<Courses class="my-5" :max="4"></Courses>
			<div class="d-flex flex-row justify-content-center">
				<b-btn variant="outline-secondary" to="/courses">Všetky kurzy</b-btn>
			</div>
		</b-col>
	</b-col>
</template>

<style scoped>
	.main-image {
		position: absolute;
		top: 0;
		right: 0;
		max-width: 50vw;
	}

	.tech-show-image {
		height: 50px;
		width: auto;
	}

	.feature {
		max-width: 25%;
		min-width: 300px;
		margin-left: 10px;
		margin-right: 10px;
		margin-bottom: 50px;
	}

	.feature-image {
		width: 100%;
		height: 200px;
		object-fit: contain;
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"

	@Component({
		components: {
			Courses: () => import("@/components/Courses.vue")
		}
	})
	export default class Home extends Vue {
	}
</script>
