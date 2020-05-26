<template>
    <b-navbar>
        <b-navbar-brand to="/">
            <b-img src="@/assets/img/logo/KurzCademyLogoBezTextu.png" height="50px"></b-img>
        </b-navbar-brand>
    </b-navbar>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component"
import * as vueProp from "vue-property-decorator"

@Component
export default class Header extends Vue {
   
}
</script>