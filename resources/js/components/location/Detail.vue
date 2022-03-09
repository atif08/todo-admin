<template>
    <div>
        <div class="grid grid-cols-2 gap-4 mt-9">
            <div class=" grid grid-rows-2 gap-4 col-span-2 lg:col-span-1">
                <div class="p-4 md:p-6 2xl:p-8 bg-white rounded-md shadow-md">
                    <div>
                        <h3 class="font-medium text-lg">Location</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';


    export default {
        name: 'detail',
        data() {
            return {
            }
        },
        mounted() {
        },
        created() {
            this.getLocationDetail();
        },
        methods: {
            getLocationDetail() {
                this.axios.get('/api/locations/' +  this.$route.params.id).then((response) => {
                    if (response.data.data) {
                        this.subscriberDetailData.user.name = response.data.data.user.name;
                        this.subscriberDetailData.user.email = response.data.data.user.email;
                        if (response.data.data.membership) {
                            this.subscriberDetailData = response.data.data;
                        }
                    }
                })
            },


        }
    }
</script>
