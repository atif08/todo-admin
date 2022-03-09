<template>
    <header class="relative z-30">
        <div id="bg-overlay"></div>
        <div class="w-0 lg:w-60 transition-all duration-100 bg-mocono-100 h-screen" id="side-menu">
            <div class="mt-9 mb-8 ml-2 w-85vw lg:w-full flex justify-between items-center relative z-0">
                <a href="/tasks"><h1
                    class="text-white text-2xl xs:text-3xl sm:text-4xl font-semibold pl-4 lg:pl-1 w-48" id="logo">
                    <img src="/assets/img/logo.webp" alt="" class="w-full">
                </h1></a>
                <div class="lg:hidden">
                    <button class="text-white text-lg focus:outline-none border-none outline-none" id="burger-menu"><i
                        class="fas fa-bars"></i></button>
                </div>
            </div>
            <nav x-data="{selected:null}" class="overflow-hidden lg:overflow-visible">
                <ul class="pl-3 lg:pl-0">


                    <li id="performance" v-if="role=='super-admin' || role=='user' "
                        class="mt-8 2xl:mt-17 mb-6 ml-5 text-white text-sm 2xl:text-base"
                        x-on:click="selected !== 2 ? selected = 2 : selected = null">
                        <router-link to="/tasks" exact class="flex items-end gap-3 w-full"><img
                            src="/assets/img/performance.png" alt="" width="28"> <span>Task</span></router-link>
                    </li>
                    <li v-if="role=='super-admin' || role=='user' "
                        class="my-6 text-white  ml-5 text-sm 2xl:text-base" id="paywall"
                        x-on:click="selected !== 3 ? selected = 3 : selected = null">
                        <router-link to="/location" class="flex items-end gap-3 w-full"><img
                            src="/assets/img/paywall.png" alt="" width="28"> <span>Location</span></router-link>
                    </li>
                    <li v-if="role=='super-admin' "
                        class="my-6 text-white  ml-5 text-sm 2xl:text-base " id="users"
                        x-on:click="selected !== 1 ? selected = 1 : selected = null">
                        <router-link to="/users" class="flex items-end gap-3 w-full"><img
                            src="/assets/img/paywall.png" alt="" width="28"> <span>Users</span></router-link>
                    </li>
                </ul>
                <div class="absolute bottom-6 right-5">
                    <button class="w-56 h-10 rounded-md text-white" @click.prevent="logout"
                            style="background-color: #512B6B;">Logout
                    </button>
                    <p class="text-xs text-white text-center">Signed in as {{email}}</p>
                </div>
            </nav>
        </div>
    </header>
</template>
<script>
    export default {
        name: "sidebar",
        data() {
            return {
                role: false,
                isLoggedIn: false,
                email: 'vexalist@gmail.com',
                active_el: 0,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        mounted() {

        },
        created() {
            this.email = window.Laravel.user.email;
            this.role = this.$store.state.role;
        },
        methods: {
            logout() {
                this.axios.get('/sanctum/csrf-cookie').then(response => { });
                this.axios.post('/logout').then(response => {
                    localStorage.setItem('publicationId', '');
                    localStorage.setItem('userId', '');
                    this.$router.push({path: '/login'});
                    location.reload();
                }).catch(error => {
//                    location.reload();
                });

            },
            //before the route is mounted we check if the user is logged in
            beforeRouteEnter(to, from, next) {
                if (!JSON.parse(window.Laravel).isLoggedin) {
                    return next('/login');
                }
                next('/');
            },

        }
    };
</script>
