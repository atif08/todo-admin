<template>

        <header class="border-b px-4 md:px-8 py-4 flex items-center gap-3 justify-between">
            <div class="flex items-center gap-2">
            </div>
            <div class="flex items-center gap-2">
                <div class=" flex items-center gap-2">
                    <p class=" text-sm 2xl:text-base text-right hidden sm:block mt-2 mr-2 capitalize">{{name}}</p>
                    <div class="w-12 h-12 hidden"><img src="/admin/img/placeholder.png" alt=""></div>
                </div>

                <div>
                    <button @click.prevent="logout"  class="border-none w-20 h-10 bg-mocono-300 text-white rounded-lg shadow-custom text-sm 2xl:text-base">
                        Logout
                    </button>
                </div>
            </div>
        </header>

</template>

<script>
    export default {
        data() {
            return {
                isLoggedIn: true,
            }
        },
        created(){
            this.name=window.Laravel.user.name
        },
        methods: {

            logout() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                });
                axios.post('/logout').then(response => {
                    localStorage.setItem('publicationId', '');
                    localStorage.setItem('userId', '');
                    this.$router.push({path: '/login'});
                    location.reload();
                }).catch(error => {
//                    location.reload();
                });
            },
        }
    };
</script>
<style>
    .text-capitalize{
        text-transform: capitalize;
    }
</style>
