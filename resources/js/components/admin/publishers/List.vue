<template>
   <div>
       <div class="px-4 md:px-8 pt-4 pb-16">


           <!-- table starts     -->
           <div class="flex flex-col mt-4 overflow-hidden">
               <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                   <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                       <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                           <table class="min-w-full divide-y divide-gray-200">
                               <thead class="bg-white">
                               <tr>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                                       Publication Name
                                   </th>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                                       Billing Status
                                   </th>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                                       Publisher
                                   </th>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                                       Publication
                                   </th>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">
                                       Active
                                   </th>
                               </tr>
                               </thead>
                               <tbody class="bg-white divide-y divide-gray-200">

                               <tr v-if="allPublications.length>0" v-for="item in allPublications">
                                   <td class=" px-5 py-4 whitespace-nowrap">
                                       <div class="flex items-center">
                                           <div class="ml-4">
                                               <div class="text-xs sm:text-sm font-medium text-gray-900">
                                                   {{item.company_name}}
                                               </div>
                                           </div>
                                       </div>
                                   </td>
                                   <td class=" px-5 py-4 whitespace-nowrap">
                                       <div class="text-xs sm:text-sm text-gray-900">Overdue</div>
                                   </td>
                                   <td class=" px-5 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                       {{item.user.name}}
                                   </td>
                                   <td class=" px-5 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                      <router-link  :to="{ path: '/admin/publication/detail/'+ item.id}">
                                          Go to Publication
                                      </router-link>
                                   </td>
                                   <td class=" px-5 py-4 whitespace-nowrap text-xs sm:text-sm text-black">
                                       <img src="/admin/img/tick.jpg" alt="" class="w-6 h-6">
                                   </td>
                               </tr>


                               <!-- More people... -->
                               </tbody>
                           </table>

                       </div>
                   </div>
               </div>
           </div>
           <!-- table ends     -->

       </div>
   </div>
</template>
<script>
    export default {
        data() {
            return {
                allPublications:[],
            }
        },
        created(){
            this.getPublishers();
        },
        methods: {
            getPublishers(page = 1, generalSearch){
                this.axios.get('/api/admin/publications-list?page=' + page + '&generalSearch='+generalSearch )
                    .then(res => {
                        if (res.status == 200) {
                            this.allPublications = res.data.data.data;
                            this.laravelData = res.data.data;
                        }
                    }).catch(err => {
                    console.log(err)
                });
            },
        }
    };
</script>
