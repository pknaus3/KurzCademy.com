import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
import './plugins/bootstrap-vue'
import './plugins/portal-vue'
import App from './App.vue'
import router from './router'
import { loadUserData } from './user'

Vue.config.productionTip = false

loadUserData().then(() => new Vue({
    router,
    render: h => h(App)
}).$mount('#app'))

