<template>
	<div class="d-flex flex-row footer mx-5 mb-5">
		<div>
			© 2020 všetky práva vyhradené
			<b>KurzCademy.com</b>
		</div>
		<div class="flex-fill"></div>
		<div>
			Sledujte nás na sociálných sietiach
			<a href="https://www.facebook.com/OpenLab.sk/">
				<b-img src="@/assets/img/otherLogos/fb-black-nbg.png" class="footer-img"></b-img>
			</a>
			<a href="https://www.instagram.com/openlab.sk/">
				<b-img src="@/assets/img/otherLogos/ig-black-nbg.png" class="footer-img"></b-img>
			</a>
			<a href="https://www.linkedin.com/company/openlab-sk">
				<b-img src="@/assets/img/otherLogos/in-black-nbg.png" class="footer-img"></b-img>
			</a>
		</div>
	</div>
</template>

<style scoped>
	.footer-img {
		opacity: 0.5;
        height: 16px;
        margin-right: 4px;
	}

	.footer {
		color: rgba(0, 0, 0, 0.5);
	}
</style>

<script lang="ts">
	import Vue from 'vue'
	import Component from "vue-class-component"
	import * as vueProp from "vue-property-decorator"

	@Component
	export default class Footer extends Vue {

	}
</script>