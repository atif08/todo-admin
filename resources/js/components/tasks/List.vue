<template>
    <div>
        <div class="flex lg:items-center justify-between mt-8 flex-col lg:flex-row">
            <div class="mt-3 lg:mt-0">
                <div class=" flex md:items-center flex-col md:flex-row">

                    <div class="flex sm:items-center flex-col sm:flex-row" >
                        <div class="flex sm:items-center flex-col sm:flex-row mt-2 md:mt-0">
                            <div class="mx-1 my-1">
                            </div>
                        </div>
                        <div class="mx-1 my-1" >
                            <button class="w-full sm:w-36 h-10 rounded-md text-sm font-medium"
                                    @click="addSubscriberModalVisible">
                                + Add new task
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex flex-col mt-4 ">
            <div class="-my-2 overflow-x-auto" id="table-width">
                <div class="my-2 w-full">
                    <div class="border-gray-200 sm:rounded-lg w-full " v-if="tasks.length>0">
                        <h3><b>Incomplete</b></h3>
                        <div class="mt-5 mb-5" v-for="task in tasks" >
                            <span v-if="task.status==0">
                                <p class="text-sm"> <input type="checkbox" name="">    <span>{{task.title}}</span></p>
                                <p class="text-sm pl-5">{{task.due_at}}</p>
                            </span>

                        </div>
                        <h3><b>Completed</b></h3>
                        <div class="mt-5 mb-5" style="color: #b2a7a7;" v-for="task in tasks">
                           <span v-if="task.status==1">
                                <p class="text-sm"> <input type="checkbox" checked name="">    <span>{{task.title}}</span></p>
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ///////table ends////////// -->
        <!--Modal-->
        <div class="modal fade" id="addSubscriberModal" v-show="isAddSubscriberModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
            <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center" style="z-index:10500;">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal-container bg-white w-136 2xl:w-144 md:max-w-144 max-h-136 2xl:max-h-144 mx-auto rounded shadow-lg z-40 overflow-y-auto">


                    <div class="w-full h-3 bg-black rounded-t-md relative -top-1 z-50"></div>
                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="sm:p-8 p-4 rounded-md bg-white w-full mx-auto">
                        <h3 class="font-semibold text-base 2xl:text-lg">New Task</h3>
                        <div class="mt-7">
                            <form action="" method="POST" @submit.prevent="subscriberStore">
                                <div class="flex flex-col my-5">
                                    <label for="name" class="text-sm 2xl:text-base">Summary</label>
                                    <input type="text" v-model="formData.title" id="name"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="Summary">
                                </div>
                                <div class="flex flex-col my-5">
                                    <label for="description" class="text-sm 2xl:text-base">Description</label>
                                    <input type="text" name="description" v-model="formData.description" id="description"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="Description">

                                </div>
                                <div class="flex flex-col my-5">
                                    <label for="due_date" class="text-sm 2xl:text-base">Due Date</label>
                                    <input type="date" name="due_at" v-model="formData.due_at" id="due_date"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="">

                                </div>
                                <div class="flex justify-end">
                                    <input type="submit" value="Add Subscriber"
                                           v-bind:class="{ 'i-am-clicked': button_active_clicked }"
                                           v-bind:disabled="hasDisabled"
                                           class="py-3 px-3 rounded-md text-white bg-mocono-300 cursor-pointer text-sm 2xl:text-base">
                                    <button type="button"
                                            class="text-sm 2xl:text-base text-mocono-dark bg-gray-200 p-3 rounded-md mx-2"
                                            @click="addSubscriberModalClose">Close
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" v-model="subscriber_id">
        </div>
    </div>
</template>
<script>


    import moment from 'moment';

    export default {
        name: "App",

        data() {
            return {
                tasks: [],
                hasDisabled: false,
                button_active_clicked: false,
                formData: {
                    title: '',
                    description: '',
                    due_at: '',
                },
                active: '<div class="h-2 w-2 rounded-full bg-green-500"></div><span class="ml-2">Active</span>',
                inactive: '<div class="h-2 w-2 rounded-full bg-red-500"></div><span class="ml-2">Inactive</span>',
                isAddSubscriberModal: false,
                subscriber_id:''
            }
        },
        mounted() {
            this.getAll();
        },
        created() {
            this.role = this.$store.state.role;
        },
        computed: {


        },
        methods: {


            getAll() {

                this.axios.get('/api/tasks').then(response => {
                   // console.log(response);
                        if (response.status == 200) {
                            this.tasks = response.data.tasks;
                        }
                    }).catch(err => {
                });
            },




            subscriberStore(){
                this.hasDisabled = true;
                this.button_active_clicked = true;
                this.axios.post('/api/tasks',
                    {
                        status : 0,
                        title : this.formData.title,
                        description : this.formData.description,
                        due_at : this.formData.due_at,
                         }
                ).then((response) => {
                    this.hasDisabled = false;
                    this.button_active_clicked = false;
                        this.isAddSubscriberModal = false;
                        Vue.$toast.success('Added Successfully ', {position: 'top-right'});
                    this.formData={}
                    this.getAll();

                }).catch(error => {
                    this.hasDisabled = false;
                    this.button_active_clicked = false;
                    this.errors = JSON.stringify(error.response);
                    Vue.$toast.error((JSON.parse(this.errors).data.message)?JSON.parse(this.errors).data.message:JSON.parse(this.errors).message, {position: 'top-right'});


                });
            },

            addSubscriberModalVisible() {
                this.isAddSubscriberModal = true;
            },
            addSubscriberModalClose() {
                //location.reload();
                 this.isAddSubscriberModal = false;

            },
        }
    }
</script>

<style>
    .width65 {
        width: 65px;
    }

    .dateRangePickerClass .mdrp__activator .activator-wrapper .text-field {
        font-size: 0.875rem;
        height: 2.5rem;
        padding-bottom: 4px;
    }
    input.text-field.text-field__filled{
        width: 100% !important;
    }
</style>
