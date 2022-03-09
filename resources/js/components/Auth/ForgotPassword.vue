<template>
    <div>
        <div class="w-87/5 mx-auto">
        <main class="bg-mocono-gray">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">Forget Password</h4>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                    <form class="bg-white p-8 rounded shadow-sm"  @submit.prevent="forgetPassword">
                        <div class="flex flex-col" :class="{ 'hasError': $v.submitForm.email.$error }">
                            <label class="font-medium text-mocono-text text-sm 2xl:text-base mb-2" for="email">Email </label>
                            <input type="email" v-model="submitForm.email" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4 text-sm 2xl:text-base" id="email" >
                            <small class="text-danger" v-if="submitForm.error_email" style="margin-top: -10px;">{{ submitForm.error_email }} </small>
                        </div>
                        <div class="flex justify-between items-center my-3">
                            <router-link to="/register" class="text-sm 2xl:text-base text-mocono-300 hover:text-mocono-200 transition hover:underline">Create an account</router-link>
                            <router-link to="/login" class="text-sm 2xl:text-base text-mocono-300 hover:text-mocono-200 transition hover:underline">Login</router-link>
                        </div>
                        <div class="w-full flex justify-center md:justify-end mt-4 ">
                            <button type="submit" class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none"
                                    aria-label="Create Account Button">Submit</button>
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
                    email: "",
                    error_email: "",
                },
            }
        },
        validations: {
            submitForm: {
                email: { required, email }
            }
        },
        methods:{
            forgetPassword(){
                this.$v.submitForm.$touch();
                if(this.$v.submitForm.$error) return;
                this.axios.get('/sanctum/csrf-cookie').then(response => {
                    this.axios.post('/api/forget-password-send-email',
                        {email:this.submitForm.email})
                        .then((response) => {
                            Vue.$toast.success('Email send successfully please check your email! ',{position: 'top-right'});
                    }).catch(error => {
                        // Vue.$toast.error('Email not exist', {position: 'top-right'});
                        this.errors = JSON.stringify(error.response);
                        Vue.$toast.error((JSON.parse(this.errors).data.message)?JSON.parse(this.errors).data.message:JSON.parse(this.errors).message, {position: 'top-right'});
                        this.submitForm.error_email = JSON.parse(this.errors).errors.email[0];
                    });
                });
            }
        }
    }
</script>
