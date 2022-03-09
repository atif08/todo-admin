/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueAxios from 'vue-axios';
window.Vue = Vue;
import VueRouter from 'vue-router';
import axios from 'axios';
import routes from './routes';
import sidebar from './layouts/sidebar.vue';
import footer from './layouts/footer.vue';
import HeaderView from './components/HeaderView.vue';


Vue.component('sidebar-component',sidebar);
Vue.component('footer-component',footer);
Vue.component('header-view-component',HeaderView);

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
const router = new VueRouter(routes);
const app = new Vue({
    el: '#app',
    router: router
});
