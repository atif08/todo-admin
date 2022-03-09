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
import adminSidebar from './components/admin/include/AdminSidebar.vue';
import adminHeaderView from './components/admin/include/AdminHeader.vue';
import footer from './layouts/footer.vue';
import HeaderView from './components/HeaderView.vue';
import VueToast from 'vue-toast-notification';
import VueCompositionAPI from '@vue/composition-api';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';
import Vuex from 'vuex';
import Vuelidate from 'vuelidate';

import VMdDateRangePicker from "v-md-date-range-picker";
///////////// cookie
import VueCookies from 'vue-cookies';


Vue.use(Vuex);
Vue.use(Vuelidate);
Vue.use(VMdDateRangePicker);
Vue.use(VueCookies);
Vue.prototype.$userId = localStorage.getItem('userId');

Vue.prototype.$membership = localStorage.getItem('membershipId');
Vue.component('sidebar-component', sidebar);
Vue.component('admin-sidebar-component', adminSidebar);
Vue.component('admin-header-view-component', adminHeaderView);
Vue.component('footer-component', footer);
Vue.component('header-view-component', HeaderView);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VueToast);
Vue.use(VueRouter);
Vue.use(VueCompositionAPI);
Vue.use(VueAxios, axios);
Vue.use(require('vue-moment'));

const store = new Vuex.Store({
    state: {
        user: localStorage.getItem('user'),
        publicationId: localStorage.getItem('publicationId'),
        role: localStorage.getItem('userTypeRole'),
        isGrantSupportAccess: localStorage.getItem('isGrantSupportAccess'),
        // authenticated:false
    }
})

const router = new VueRouter(
    routes, {
        base: process.env.BASE_URL,
    }
);
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        //alert(to.meta.type);
        if (!window.Laravel.isLoggedin) {
            next({ name: 'login' })
        } else {
           /* if (window.Laravel.type == 0) {

                // window.location.href = "/admin/dashboard";
                next()
            }
            if (window.Laravel.type == 1) {
                next() // go to wherever I'm going
            }*/
            next()
        }
    } else {
        next() // does not require auth, make sure to always call next()!
    }
})


const app = new Vue({
    el: '#app',

    store: store,
    router: router,

});
