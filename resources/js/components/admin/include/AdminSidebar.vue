<template>

    <aside class="h-screen w-20 lg:w-60 fixed ml-5 left-0">

        <nav class="overflow-hidden lg:overflow-visible">
            <ul class="pl-0 lg:pl-3">
                <li class="mt-12 lg:mt-17 my-6 text-white text-sm 2xl:text-base" >
                    <router-link to="/admin/dashboard" class="flex items-end gap-3 w-full ml-5" id="performance">
                        <img src="/assets/img/performance.png" alt="" width="28">
                        <span class="hidden lg:block">Dashboard</span>
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>

</template>
<script>
    export default {};
</script>
