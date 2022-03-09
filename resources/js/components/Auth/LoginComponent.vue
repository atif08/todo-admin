<template>
    <div>
        <div class="w-87/5 mx-auto">

        <main class="bg-mocono-gray">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">Login</h4>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                    <form class="bg-white p-8 rounded shadow-sm"  @submit.prevent="login">
                        <div class="flex flex-col" :class="{ 'hasError': $v.loginForm.email.$error }">
                            <label class="font-medium text-mocono-text text-sm 2xl:text-base mb-2" for="email">Email</label>
                            <input type="email" v-model="loginForm.email" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4 text-sm 2xl:text-base" id="email" >
                            <small class="text-danger" v-if="loginForm.error_email" style="margin-top: -10px;">{{ loginForm.error_email }} </small>
                        </div>
                        <div class="flex flex-col" :class="{ 'hasError': $v.loginForm.password.$error }">
                            <label class="font-medium text-mocono-text text-sm 2xl:text-base mb-2" for="password">Enter your password</label>
                            <input type="password" v-model="loginForm.password"  class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4 text-sm 2xl:text-base" id="password" >
                            <small class="text-danger">{{ loginForm.error_password }} </small>
                        </div>
                        <div class="flex justify-between items-center my-3">
                            <router-link to="/forgot-password-send-email" class="text-sm 2xl:text-base text-blue-600 hover:text-blue-400 transition">Forgot Password?</router-link>
                        </div>
                        <div class="w-full flex justify-center md:justify-end mt-4 ">

                            <button type="submit" v-bind:class="{ 'i-am-clicked': button_active_clicked }" class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none" aria-label="Create Account Button">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </main>
        </div>
    </div>
</template>

<script>
    import { required, email, minLength } from "vuelidate/lib/validators";
    export default {
        data(){
          return {
              button_active_clicked: false,
              loginForm: {
                  email: "",
                  password: "",
                  error_email: "",
                  error_password: "",
              },
              errors:[]
          }
        },
        validations: {
            loginForm: {
                password: { required, },
                email: { required, email }
            }
        },
        created() {
            if(window.Laravel.isLoggedin && window.Laravel.type==2){
                this.$router.push({path: '/tasks'})
            }

            if(window.Laravel.isLoggedin && window.Laravel.type==1){
                this.$router.push({path: '/admin/dashboard'})
            }
        },
        methods:{
            login(){
                this.$v.loginForm.$touch();
                if(this.$v.loginForm.$error) return;
                this.button_active_clicked=true;
                this.axios.get('/sanctum/csrf-cookie').then(response => {
                    this.axios.post('/api/login',{email:this.loginForm.email,password:this.loginForm.password}).then((response) => {
                        console.log(response.data.type);
                        if(response.data.type===1){
                            this.$router.push({path: '/admin/dashboard'});
                        }
                        if(response.data.type===2){
                            // localStorage.setItem('userId', response.data.data.id );
                            localStorage.setItem('userId', 2 );
                            this.$router.push({path: '/tasks'});
                        }
                        Vue.$toast.success('Login Successfully ',{position: 'top-right'});
                          location.reload();
                       // window.location.reload();
                        this.button_active_clicked=false;
                    }).catch(error => {
                        this.button_active_clicked=false;
                        this.errors=JSON.stringify(error.response.data);
                        this.loginForm.error_email = JSON.parse(this.errors).errors.email[0];
                        this.loginForm.error_password = JSON.parse(this.errors).errors.password[0];
                        Vue.$toast.error('Email or password does not match ',{position: 'top-right'});
                    })
                })

            },

        }
    }
</script>
