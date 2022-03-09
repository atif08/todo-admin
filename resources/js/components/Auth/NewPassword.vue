<template>
    <div>
        <div class="w-87/5 mx-auto">

        <main class="bg-mocono-gray">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">New Password</h4>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                    <form class="bg-white p-8 rounded shadow-sm" @submit.prevent="forgetPassword">
                        <div class="flex flex-col" :class="{ 'hasError': $v.submitForm.password.$error }">
                            <label class="font-medium text-mocono-text text-sm 2xl:text-base mb-2" for="new_password">Password</label>
                            <input type="password" name="new_password" v-model="submitForm.password"  id="new_password" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4 text-sm 2xl:text-base" >
                            <small class="text-danger" v-if="submitForm.error_password" style="margin-top: -10px;">{{ submitForm.error_password }} </small>
                        </div>
                        <div class="flex flex-col" :class="{ 'hasError': $v.submitForm.password_confirmation.$error }">
                            <label class="font-medium text-mocono-text text-sm 2xl:text-base mb-2" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation"  v-model="submitForm.password_confirmation"id="password_confirmation" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4 text-sm 2xl:text-base" >
                            <small class="text-danger" v-if="submitForm.error_confirm_password" style="margin-top: -10px;">{{ submitForm.error_confirm_password }} </small>
                        </div>
                        <div class="flex justify-between items-center my-3">
                            <router-link to="/login" class="text-sm 2xl:text-base text-mocono-300 hover:text-mocono-200 transition hover:underline">Login</router-link>
                        </div>
                        <div class="w-full flex justify-center md:justify-end mt-4 ">
                            <button type="submit" class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none" aria-label="Create Account Button">Submit</button>
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
                submitForm: {
                    password: "",
                    password_confirmation: "",
                    error_password: "",
                    error_confirm_password: "",
                },
            }
        },
        validations: {
            submitForm: {
                password: { required },
                password_confirmation: { required }

            }
        },
        created() {
            console.log(this.$route.query.email)
        },
        methods:{
            forgetPassword(){
                this.$v.submitForm.$touch();
                if(this.$v.submitForm.$error) return;
                this.axios.get('/sanctum/csrf-cookie').then(response => {
                    this.axios.post('/api/forget-password',
                        {
                            email:this.$route.query.email,
                            forget_token:this.$route.query.token,
                            password:this.submitForm.password,
                            password_confirmation:this.submitForm.password_confirmation
                        })
                        .then((response) => {
                            Vue.$toast.success('Changed password successfully ', {position: 'top-right'});
                            this.$router.push({path: '/login'})
                        }).catch(error => {
                            console.log(error.response.data);
                            if(error.response.data.code==400){
                            Vue.$toast.error(error.response.data.message, {position: 'top-right'});
                            this.$router.push({path: '/forgot-password-send-email'})
                        }

                        this.errors = JSON.stringify(error.response.data);
                        Vue.$toast.error(JSON.parse(this.errors).errors.password[0], {position: 'top-right'});
                        this.submitForm.error_password = JSON.parse(this.errors).errors.password[0];
                    });
                });
            }
        }
    }
</script>
