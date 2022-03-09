<template>
    <div>
        <div class="w-87/5 mx-auto">
        <header>
            <div class="w-full mx-0 bg-mocono-300 flex justify-between items-center py-5 px-5">
                <h1 class="text-white text-2xl xs:text-3xl sm:text-4xl font-semibold ">mocono</h1>
                <div class="flex items-center">
                    <h5 class="mr-2 text-white text-sm sm:text-base">Joan Didion</h5>
                    <button class="text-white text-3xl focus:outline-none" aria-label="User dropdown button"><i class="fal fa-angle-down"></i></button>
                </div>
            </div>
        </header>
        <main class="bg-mocono-gray">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">Get your paywall started</h4>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                    <form class="bg-white p-8 rounded shadow-sm">
                        <div class="flex flex-col">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="domain">Website domain</label>
                            <input type="text" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded " id="domain" >
                            <span class="text-sm mb-4">E.g. mywebsite.com</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="companyname">Company Name</label>
                            <input type="text" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4" id="companyname" >
                        </div>
                        <div class="flex flex-col">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="name">Full Name</label>
                            <input type="text" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4" id="name" >
                        </div>
                        <div class="flex flex-col">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="email">Email</label>
                            <input type="email" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4" id="email" >
                        </div>
                        <div class="flex flex-col">
                            <label class="font-medium text-mocono-text text-sm sm:text-base mb-2" for="password">Create a password</label>
                            <input type="password" class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded mb-4" id="password" >
                        </div>
                        <div class="flex flex-col position-relative">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox rounded-none h-5 w-5 text-mocono-100 bg-mocono-gray border-gray-300">
                                <span class="ml-3 font-medium text-mocono-text text-sm sm:text-base">I agree to the <a href="#" class="text-mocono-200 underline">Terms and Conditions</a></span>
                            </label>
                        </div>
                    </form>
                    <div class="w-full flex justify-center md:justify-end mt-4 ">
                        <button class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none" aria-label="Create Account Button">Create account</button>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
