<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from "vue-class-component"
import * as vueProp from "vue-property-decorator"

@Component
export default class App extends Vue {
   
}
</script>
