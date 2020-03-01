import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
// bootstrap
import './plugins/bootstrap-vue'
// axios
import axios from 'axios'
// progressbar
import VueScrollProgressBar from '@guillaumebriday/vue-scroll-progress-bar'
// multiselect
import Multiselect from 'vue-multiselect'
//date 
import moment from 'moment'
//search text box
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'


import App from './App.vue'
import VueRouter from 'vue-router'
import About from './components/About.vue'
import Home from './components/Home.vue'
import Edit from './components/Edit.vue'
import Report from './components/Report.vue'
import Person from './components/Person.vue'
import Login from './components/Login.vue'


// good table
import VueGoodTablePlugin from 'vue-good-table';










// bootstrap
import { BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
// multiselect
import 'vue-multiselect/dist/vue-multiselect.min.css'

// good table
import 'vue-good-table/dist/vue-good-table.css'


// bootstrap
Vue.use(BootstrapVueIcons)
    // axios
Vue.use(axios)
    // progressbar
Vue.use(VueScrollProgressBar)
    // multiselect
Vue.component('multiselect', Multiselect)
    //date
Vue.use(moment)
    // search text box
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)

Vue.use(VueRouter)
    //good table
Vue.use(VueGoodTablePlugin);

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/edit/:num', component: Edit },
    { path: '/report', component: Report },
    { path: '/person/:num', component: Person },
    { name: "home", path: '/login', component: Login }


]
const router = new VueRouter({
    routes,
    // mode: 'history' //remove # from url
})



Vue.config.productionTip = false

new Vue({
    router,

    render: h => h(App),
}).$mount('#app')