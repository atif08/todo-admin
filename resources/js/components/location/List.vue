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
                                    @click="getLocation">
                                + Check In
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex flex-col mt-4 ">
            <div class="-my-2 overflow-x-auto" id="table-width">
                <div class="my-2 w-full">
                    <div class="border-gray-200 sm:rounded-lg w-full ">
                        <h3><b>Current location</b></h3>
                        <div class="mt-5 mb-5"  >
                            <span >
                                <p class="text-sm"> <i style='font-size:12px' class='fas'>&#xf276;</i>  <span id="current_location"> {{current_location}}</span></p>
                                <p class="pl-4"><span id="location_lat">{{latitude}}</span>, <span id="location_long">{{longitude}} </span></p>
                            </span>

                        </div>
                        <h3><b>Previous location</b></h3>
                        <div class="mt-5 mb-5" style="color: #b2a7a7;" v-for="item in locations">
                           <span>
                                <p class="text-sm"><i style='font-size:12px' class='fas'>&#xf276;</i>   <span>{{item.location}}</span></p>
                               <p class="pl-4"><span >{{item.latitude}}</span>, <span >{{item.longitude}} </span></p>
                            </span>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>
<script>


    import moment from 'moment';

    export default {
        name: "App",

        data() {
            return {
                locations: [],
                current_location: '',
                latitude: '',
                longitude: '',
                hasDisabled: false,
                button_active_clicked: false,
                formData: {
                    user_id: '',
                    location: '',
                },
            }
        },
        mounted() {
             this.getAll();
             this.getSingle();
        },
        created() {
            this.role = this.$store.state.role;
        },
        computed: {


        },
        methods: {
            getSingle() {
                this.axios.get('/api/current-location').then(response => {
                    console.log(response);
                            this.current_location = response.data.location;
                            this.latitude = response.data.latitude;
                            this.longitude = response.data.longitude;

                    }).catch(err => {
                });
            },
            getAll() {

                this.axios.get('/api/locations').then(response => {
                   // console.log(response);
                            this.locations = response.data.locations;

                    }).catch(err => {
                });
            },
           getLocation(){
               if(navigator.geolocation) {
                   navigator.geolocation.getCurrentPosition(function(position) {
                       var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&key=AIzaSyDLTspp612BPk6P668hOjZEIAvWgKvNZNg&sensor=false";
                       $.get(url, function(data) {
                           var results = data.results;
                           if (data.status === 'OK')
                           {
                               if (results[0])
                               {
                                   var formatted_address = results[0].formatted_address;
                                   this.current_location=formatted_address;
                                   document.getElementById('current_location').innerHTML=formatted_address;
                                   document.getElementById('location_lat').innerHTML=position.coords.latitude;
                                   document.getElementById('location_long').innerHTML=position.coords.longitude;
                               //    post data
                                   let postObj = {

                                       status: 1,
                                       location: formatted_address,
                                       latitude: position.coords.latitude,
                                       longitude: position.coords.longitude,

                                   }

                                   let post = JSON.stringify(postObj)

                                   const url = "/api/locations"
                                   let xhr = new XMLHttpRequest()

                                   xhr.open('POST', url, true)
                                   xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
                                   xhr.send(post);

                                   xhr.onload = function () {
                                       if(xhr.status === 201) {
                                           console.log("Post successfully created!")
                                       }
                                   }
                               //    post data end
                               }
                               else
                               {
                                   window.alert('No results found');
                               }
                           }
                           else
                           {
                               window.alert('Geocoder failed due to: ' + status);

                           }
                       });
                   })
               }
           },

            postLocation(){
                alert('ddd');
            }

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
