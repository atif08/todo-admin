<template>
    <div>
        <!-- ///////Import Download CSV and add subscriber buttons row starts////////// -->
        <div class="flex lg:items-center justify-between mt-8 flex-col lg:flex-row">
            <div class="">
                <div><h1 class="text-xl font-medium 2xl:text-2xl">All Users</h1></div>
            </div>
            <div class="mt-3 lg:mt-0">
                <div class=" flex md:items-center flex-col md:flex-row">
                    <div class="relative w-full xl:w-64 mx-1">
                    <span class="absolute inset-y-0 right-0 flex items-center pl-2">
                    <button type="submit" class="py-1 px-2 focus:outline-none focus:shadow-outline">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                           stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                     </span>
                        <input type="text" name="" v-model="searchKeywords" placeholder="Search"
                               @keyup="queryForKeywords" class="w-full xl:w-64 border-none rounded-md">
                        <!--                        <input type="text" name="" v-model="searchKeywords" placeholder="Search" class="w-full xl:w-64 border-none rounded-md">-->
                    </div>
                    <div class="flex sm:items-center flex-col sm:flex-row" v-if="role=='super-admin' ">
                        <div class="mx-1 my-1" >
                            <button class="w-full sm:w-36 h-10 text-white bg-mocono-200 rounded-md text-sm font-medium"
                                    @click="addUserModalVisible">
                                +Add User
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ///////Import Download CSV and add subscriber buttons row end////////// -->
        <!-- ///////filter row starts////////// -->
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-2 mt-10">

            <div class="w-full subscriberShadow">
                <select name="" v-model="subStatus" @change="onChangeStatus($event)"
                        class="border-0 bg-white rounded h-10 w-full py-1 text-sm">
                    <option value="all">Any status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </div>
        <!-- ///////filter row ends////////// -->
        <!-- ///////table starts////////// -->
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col mt-4 ">
            <div class="-my-2 overflow-x-auto" id="table-width">
                <div class="my-2 w-full">
                    <div class="border-gray-200 sm:rounded-lg w-full ">
                        <table class="min-w-full divide-y divide-gray-200 border-collapse w-full subscriberShadow">
                            <thead class="bg-white ">
                            <tr class="rounded-t-md">
                                <th scope="col"
                                    class="rounded-tl-md px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Created At
                                </th>
                                <th scope="col"
                                    class="px-4 rounded-tr-md py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-4 rounded-tr-md py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody v-if="users.length>0" class="divide-y divide-gray-200">
                            <!--                            <tr v-for="item in users" :key="item.id" v-if="item.subscriber_memberships && item.user ">-->


                            <tr v-for="item in users" :key="item.id" v-if="item ">
                                <td class=" px-5 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-xs sm:text-sm font-medium text-gray-900">
                                                <router-link :to="{ path: '/users/detail/'+ item.id}"
                                                             class=""> {{item.name}}
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class=" px-4 py-4 whitespace-nowrap">
                                    <div class="text-xs sm:text-sm text-gray-900"> {{item.email}}</div>
                                </td>

                                <td class=" px-4 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                    <span>{{  item.created_at  | moment("DD MMM YYYY") }}</span>
                                </td>

                                <td class=" px-4 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                    <div v-html="(item.status === 1) ? active : inactive" class="flex items-center">
                                    </div>
                                </td>
                                <td class=" px-4 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                    <a href="javascript:void(0);"  @click="editUser(item.id)">Edit</a> | <a href="javascript:void(0);"  @click="deleteUser(item.id)">Delete</a>
                                </td>
                            </tr>


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <!-- ///////table ends////////// -->
        <!--Modal-->
        <div class="modal fade" id="addSubscriberModal" v-show="isAddUserModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
            <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center" style="z-index:10500;">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal-container bg-white w-136 2xl:w-144 md:max-w-144 max-h-136 2xl:max-h-144 mx-auto rounded shadow-lg z-40 overflow-y-auto">


                    <div class="w-full h-3 bg-black rounded-t-md relative -top-1 z-50"></div>
                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="sm:p-8 p-4 rounded-md bg-white w-full mx-auto">
                        <h3 class="font-semibold text-base 2xl:text-lg">Add a new User</h3>
                        <div class="mt-7">
                            <form action="" method="POST" @submit.prevent="submitForm">
                                <input type="hidden" v-model="formData.user_id">
                                <div class="flex flex-col my-5">
                                    <label for="name" class="text-sm 2xl:text-base">Full name</label>
                                    <input type="text" v-model="formData.name" id="name"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="Joan Brandon">
                                </div>
                                <div class="flex flex-col my-5">
                                    <label for="name" class="text-sm 2xl:text-base">Email</label>
                                    <input type="email" name="email" v-model="formData.email" id="email"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="theemail@example.com">
                                </div>
                                <div class="flex flex-col my-5">
                                    <label for="password" class="text-sm 2xl:text-base">Password</label>
                                    <input type="password" name="email" v-model="formData.password" id="password"
                                           class="border-none outline-none bg-mocono-gray mt-2 rounded-md text-sm 2xl:text-base"
                                           placeholder="***********">
                                </div>
                                <div class="flex justify-end">
                                    <input type="submit" value="Add User"
                                           v-bind:class="{ 'i-am-clicked': button_active_clicked }"
                                           v-bind:disabled="hasDisabled"
                                           class="py-3 px-3 rounded-md text-white bg-mocono-300 cursor-pointer text-sm 2xl:text-base">
                                    <button type="button"
                                            class="text-sm 2xl:text-base text-mocono-dark bg-gray-200 p-3 rounded-md mx-2"
                                            @click="addUserModalClose">Close
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>
<script>
    import {StripeElements} from 'vue-stripe-checkout';
    import {StripePlugin} from '@vue-stripe/vue-stripe';
    import moment from 'moment';

    export default {
        name: "App",
        data() {
            return {
                //pagination
                isFilterApply: false,
                hasDisabled: false,
                button_active_clicked: false,
                searchKeywords: '',
                users: [],
                subStatus: 'all',
                formData: {
                    user_id: '',
                    name: '',
                    email: '',
                    password: '',
                },
                email: null,
                active: '<div class="h-2 w-2 rounded-full bg-green-500"></div><span class="ml-2">Active</span>',
                inactive: '<div class="h-2 w-2 rounded-full bg-red-500"></div><span class="ml-2">Inactive</span>',
                isAddUserModal: false,
            }
        },
        mounted() {
            this.getAll(1, 'all', '');
        },
        created() {
            this.role = this.$store.state.role;
        },
        computed: {
        },
        methods: {
            queryForKeywords(event) {
                let status = '';
                if (this.status) {
                    status = this.status;
                } else {
                    status = 'all';
                }
                this.searchKeywords = event.target.value;
                this.getAll(1, this.subStatus, event.target.value);
            },

            onChangeStatus: function (event) {
                // alert(event.target.value);
                if (event.target.value == 'all') {
                    this.isFilterApply = false;
                    this.getAll(1,this.subStatus, event.target.value)
                } else {
                    this.isFilterApply = true;
                    this.getAll(1, this.subStatus,event.target.value)
                }
            },

            getAll(page, status, generalSearch) {
                this.axios.get('/api/admin/users?page=' + page +
                    '&status=' + status +
                    '&generalSearch=' + generalSearch
                ).then(res => {
                    console.log(res);
                            this.users = res.data.users;

                    }).catch(err => {
                    console.log(err)
                });
            },
//            submit form
            submitForm() {
                this.hasDisabled = true;
                this.button_active_clicked = true;
                this.axios.post('/api/admin/users/store',this.formData).then((response) => {
                    this.hasDisabled = false;
                    this.button_active_clicked = false;
                    this.isAddUserModal = false;
                        Vue.$toast.success(response.data.message, {position: 'top-right'});
                    this.getAll(1, this.subStatus, this.searchKeywords);

                }).catch(error => {
                    this.hasDisabled = false;
                    this.button_active_clicked = false;
                    this.errors = JSON.stringify(error.response);
                    Vue.$toast.error((JSON.parse(this.errors).data.message)?JSON.parse(this.errors).data.message:JSON.parse(this.errors).message, {position: 'top-right'});
                });
            },

            deleteUser(id){

                this.axios.get('/api/admin/users/delete/'+id
                ).then(res => {
                    this.getAll(1, this.subStatus, this.searchKeywords);
                    Vue.$toast.success('Deleted Successfully ', {position: 'top-right'});
                }).catch(err => {
                    console.log(err)
                });
            },
            editUser(id){
                this.axios.get('/api/admin/users/'+id
                ).then(res => {
                    this.isAddUserModal = true;
                    this.formData.user_id=res.data.id;
                    this.formData.name=res.data.name;
                    this.formData.email=res.data.email;
                    this.formData.password=res.data.password;
                }).catch(err => {
                    console.log(err)
                });
            },

            addUserModalVisible() {
                this.isAddUserModal = true;
            },
            addUserModalClose() {
                //location.reload();
                 this.isAddUserModal = false;
            },
        }
    }
</script>

<style>
    .subscriberShadow{
        background: white;
    }
    .reportrange-text[data-v-1ebd09d2]{
        background: white !important;
    }
    .width65 {
        width: 65px;
    }
    input.text-field.text-field__filled{
        width: 100% !important;
    }
</style>
