import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
import './plugins/axios'



import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'

// icon
import { BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
Vue.use(BootstrapVueIcons)
    // vue axios
Vue.use(VueAxios, axios)





Vue.config.productionTip = false

new Vue({
    render: h => h(App),
}).$mount('#app')