import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from './components/Dashboard.vue'
import Menu from './components/dashboard/Menu.vue'
import Products from './components/dashboard/Products.vue'
import Categories from './components/dashboard/Categories.vue'
import Variants from './components/dashboard/Variants.vue'
import Pages from './components/dashboard/Pages.vue'

import { VclFacebook } from 'vue-content-loading';
import { VueEditor } from "vue2-editor";

window.axios = require('axios');

Vue.component("Dashboard",Dashboard);
Vue.component("VclFacebook",VclFacebook);
Vue.component("VueEditor",VueEditor);

Vue.use(VueRouter);
const routes = [
    { path: '/', component: Dashboard },
    { path: '/menu', component : Menu},
    { path: '/products', component : Products},
    { path: '/categories', component : Categories},
    { path: '/variants', component : Variants},
    { path: '/pages', component : Pages},

  ]

  const router = new VueRouter({
    routes 
  })
const app = new Vue({el : "#dashboard", router : router})