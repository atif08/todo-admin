@extends('layouts.app')
@section('style')
    <style>
        .invalid-feedback p {
            color: red
        }
    </style>
@endsection
@section('content')
    <div class="w-87/5 mx-auto">
        <header>
            <div class="w-full mx-0 bg-mocono-300 flex justify-between items-center py-5 px-5">
                <h1 class="text-white text-2xl xs:text-3xl sm:text-4xl font-semibold ">mocono</h1>
                {{-- <div class="flex items-center">
                     <h5 class="mr-2 text-white text-sm sm:text-base">Joan Didion</h5>
                     <button class="text-white text-3xl focus:outline-none" aria-label="User dropdown button"><i
                                 class="fal fa-angle-down"></i></button>
                 </div>--}}
            </div>
        </header>
        <form method="POST" action="{{ url('register') }}">
           {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif--}}
            @csrf
            <input type="hidden" name="type" value="1">
        <main class="bg-mocono-gray" x-data="{ memebershipTab: 0 }">
            <div class="w-full">
                <h4 class="text-2xl md:text-3xl text-center text-mocono-300 pt-16 pb-8 font-medium">Get your paywall
                    started</h4>
            </div>
            <div x-show="memebershipTab===0" class="w-full flex justify-center">
                <div class="w-11/12  md:w-136 mb-20">
                        <div class="bg-white p-8 rounded shadow-sm mb-4">
                            <div class="flex flex-col mb-4">
                                <label class="text-base text-mocono-text text-sm mb-2"
                                       for="domain">Website
                                    domain</label>
                                <input type="text" name="website_domain" value="{{old('website_domain')}}"
                                       class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded"
                                       id="domain" placeholder="mywebsite.com">
                                <span class="text-sm">E.g. mywebsite.com</span>
                                @error('website_domain')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col  mb-4">
                                <label class="text-base text-mocono-text text-sm mb-2" for="companyname">Company
                                    Name</label>
                                <input type="text" name="company_name" value="{{old('company_name')}}"
                                       class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded "
                                       id="companyname" placeholder="Techniics Ltd">
                                @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col  mb-4">
                                <label class="text-base text-mocono-text text-sm mb-2" for="name">Full
                                    Name</label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded "
                                       id="name" placeholder="Joan Brandon">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col  mb-4">
                                <label class="text-base text-mocono-text text-sm mb-2"
                                       for="email">Email</label>
                                <input type="email" name="email" value="{{old('email')}}"
                                       class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded"
                                       id="email" placeholder="joan.brandon@example.com">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col mb-4">
                                <label class="text-base text-mocono-text text-sm mb-2" for="password">Create
                                    a password</label>
                                <input type="password" name="password" value="{{old('password')}}"
                                       class="w-full bg-mocono-gray border-none focus:border-none h-9 rounded"
                                       id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col position-relative">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_agree"
                                           class="form-checkbox rounded-none h-5 w-5 text-mocono-100 bg-mocono-gray border-gray-300"
                                           value="1">
                                    <span class="ml-3  text-mocono-text text-base">I agree to the <a
                                                href="#"
                                                class="text-mocono-200 underline text-base">Terms and Conditions</a></span>
                                </label>
                                @error('agree')
                                <span class="invalid-feedback mb-4" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <a href="{{url('login')}}" class="text-sm 2xl:text-base hover:text-gray-800 hover:underline">Have an account?</a>
                        <div class="w-full flex justify-center md:justify-end mt-4 ">
                            <button type="button" @click="memebershipTab=1" class="w-32 h-12 bg-mocono-200 text-white rounded-md focus:outline-none text-sm 2xl:text-base"
                                     aria-label="Create Account Button">Create account
                            </button>
                        </div>
                </div>
            </div>

            <div x-show="memebershipTab===1">
                <div class="" x-data="setup()">
                    <div class="w-11/12 lg:w-144 xl:w-159 bg-white mx-auto rounded shadow">
                        <ul class="flex justify-center items-center flex-col sm:flex-row border-b">

                            <li class="flex items-center cursor-pointer py-4 px-4 border-b-4"
                                @click="activeTab = 0" :class="activeTab===0 ?  'border-mocono-300' : 'border-white'">
                                <div><div class="h-6 w-6 text-white bg-mocono-unactive rounded-full flex justify-center items-center mr-2" id="unactive1">1</div></div>
                                <img src="{{asset('assets/img/completed.png')}}" alt="" class="h-6 w-6 mr-2 hidden" id="completed1">Memberships
                            </li>
                            <li class="flex items-center cursor-pointer py-4 px-4 border-b-4" @click="activeTab = 1" :class="activeTab===1 ?  'border-mocono-300' : 'border-white'">
                            <div><div class="h-6 w-6 text-white bg-mocono-unactive rounded-full flex justify-center items-center mr-2" id="unactive2">2</div></div>
                                <img src="{{asset('assets/img/completed.png')}}" alt="" class="h-6 w-6 mr-2 hidden" id="completed2">Branding
                            </li>
                            <li class="flex items-center cursor-pointer py-4 px-4 border-b-4" @click="activeTab = 2" :class="activeTab===2 ?  'border-mocono-300' : 'border-white'">
                            <div><div class="h-6 w-6 text-white bg-mocono-unactive rounded-full flex justify-center items-center mr-2">3</div></div>
                                <img src="{{asset('assets/img/completed.png')}}" alt="" class="h-6 w-6 mr-2 hidden" >Integration
                            </li>

                        </ul>
                    </div>
                    <!-- ///////////////////////////First Tab//////////////////////////////// -->
                    <div class="" x-show="activeTab===0">
                        <div class="py-6 px-8 sm:py-10 sm:px-14 w-11/12 lg:w-144 xl:w-159 bg-white mx-auto rounded shadow ">
                            <div class="mb-5">
                                <p class="font-medium text-md">Memberships Options</p>
                                @error('membership')
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            @if(isset($membershipPlans))
                                @foreach($membershipPlans as $membershipPlan)
                            <div class="border-b py-4 ">
                                <div class="grid grid-cols-1 xs:grid-cols-3 gap-4">
                                    <div class=" flex items-center">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="membership" @if(old('membership') == $membershipPlan->id     ) checked @endif value="{{$membershipPlan->id}}"
                                                   class="form-checkbox rounded-none h-5 w-5 text-mocono-200 bg-mocono-gray border-gray-300">
                                            <span class="ml-3  text-mocono-text text-sm 2xl:text-base">{{$membershipPlan->name}}</span>
                                        </label>
                                    </div>
                                    <div class=" flex items-center">
                                        <span class="mr-4 ">£</span>
                                        <input type="text" name="price_publisher"
                                               class="bg-mocono-gray border-none focus:border-none h-9 rounded w-28 "
                                               id="monthly" value="{{number_format($membershipPlan->price,2)}}">
                                        @if(isset($membershipPlan->discount))
                                        <p class="ml-3 italic text-xs 2xl:text-sm mt-2 xs:mt-0">{{$membershipPlan->discount}}% discount</p>
                                            @endif
                                        @if(isset($membershipPlan->days))
                                            <select name="" id=""
                                                    class="sm:ml-2 ml-6 w-31 border-0 bg-mocono-gray rounded h-10  py-1 mt-2 sm:mt-0">
                                                <option value="">days</option>
                                                @for ($i=1; $i<$membershipPlan->days;$i++)
                                                    <option value="{{$i}}">{{$i}} day</option>
                                                    @endfor
                                            </select>
                                        @endif
                                    </div>

                                </div>
                            </div>
                                @endforeach
                            @endif
                          {{--  <div class="border-b py-4 ">
                                <div class="grid grid-cols-1 xs:grid-cols-3 gap-4">
                                    <div class=" flex items-center">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="membership"
                                                   class="form-checkbox rounded-none h-5 w-5 text-mocono-200 bg-mocono-gray border-gray-300">
                                            <span class="ml-3 text-sm 2xl:text-base">Yearly</span>
                                        </label>
                                    </div>
                                    <div class=" flex xs:items-center flex-col xs:flex-row">
                                        <div class="flex items-center"><span class="mr-4 ">£</span>
                                            <input type="text" name=""
                                                   class="bg-mocono-gray border-none focus:border-none h-9 rounded w-28 "
                                                   id="yearly" value="50.00">
                                        </div>
                                        <p class="ml-3 italic text-xs 2xl:text-sm mt-2 xs:mt-0">16.6% discount</p>
                                    </div>

                                </div>

                            </div>
                            <div class="border-b py-4 ">
                                <div class="grid grid-cols-1 xs:grid-cols-3 gap-4">
                                    <div class=" flex items-center">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="membership"
                                                   class="form-checkbox rounded-none h-5 w-5 text-mocono-200 bg-mocono-gray border-gray-300">
                                            <span class="ml-3 text-sm 2xl:text-base">Free trial</span>
                                        </label>
                                    </div>
                                    <div class=" flex items-start sm:items-center flex-col sm:flex-row mt-3 sm:mt-0">
                                        <div class="flex items-center"><span class="mr-4 invisible">£</span>
                                            <input type="text"
                                                   class="bg-mocono-gray border-none focus:border-none h-10 rounded w-28 "
                                                   id="free-trial" value="5.00">
                                        </div>
                                        <select name="" id=""
                                                class="sm:ml-2 ml-6 w-31 border-0 bg-mocono-gray rounded h-10  py-1 mt-2 sm:mt-0">
                                            <option value="">days</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-b py-4 ">
                                <div class="grid grid-cols-1 xs:grid-cols-3 gap-4">
                                    <div class=" flex items-center">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="membership"
                                                   class="form-checkbox rounded-none h-5 w-5 text-mocono-200 bg-mocono-gray border-gray-300">
                                            <span class="ml-3 text-sm 2xl:text-base">Group discount</span>
                                        </label>
                                    </div>
                                    <div class=" flex xs:items-center flex-col xs:flex-row">
                                        <div class="flex items-center"><span class="mr-4 invisible">£</span>
                                            <input type="text"
                                                   class="bg-mocono-gray border-none focus:border-none h-9 rounded w-28 "
                                                   id="yearly" value="50.00">
                                        </div>
                                        <p class="ml-3 italic text-xs 2xl:text-sm mt-2 xs:mt-0">% discount per user</p>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="pt-9">
                                <p class=" text-md font-medium">Paywall will appear</p>
                            </div>
                            <div class="my-2">
                                <select name="paywall_will_appear" id=""
                                        class="border-0 bg-mocono-gray rounded h-10 text-sm 2xl:text-base py-1 w-44 sm:w-85">
                                    <option value="after_certain_number_articals">After a certain number of articles</option>
                                </select>
                                <input type="text" name="paywall_will_appear_price"
                                       class="bg-mocono-gray border-none focus:border-none h-10 2xl:text-base rounded w-28 text-sm mt-4"
                                       id="price" value="30.00">
                            </div>
                        </div>

                        <div class="mt-4 w-11/12 lg:w-144 xl:w-159 mx-auto flex justify-center md:justify-end">
                            <button @click="activeTab = 1" type="button" class="w-40 h-12 bg-mocono-200 text-white rounded mb-14 text-sm 2xl:text-base" id="firsttab_savebtn">
                                Save and continue
                            </button>
                        </div>
                    </div>
                    <!-- ////////////////////////////////////////First tab ends //////////////////////////////////////////// -->
                    <!-- ////////////////////////////////////////second tab starts //////////////////////////////////////////// -->
                    <div class="" x-show="activeTab===1">
                        <div class="py-6 px-8 sm:py-10 sm:px-14 w-11/12 lg:w-144 xl:w-159 bg-white mx-auto rounded shadow">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                                <div>
                                    <p class="mb-1">Headline</p>
                                    <input type="text" name="headline"
                                           class="bg-mocono-gray border-none focus:border-none h-10 rounded text-sm 2xl:text-base w-full"
                                           id="yearly" value="Get unlimited access">
                                </div>
                                <div>
                                    <p class="mb-1">Font (Google fonts)</p>
                                    <select name="google_font" id="" class="w-full border-0 bg-mocono-gray rounded h-10 py-1">
                                        <option value="open_sans" class="text-sm 2xl:text-base">Open Sans</option>
                                    </select>
                                </div>

                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-7">
                                <div>
                                    <p>Description</p>
                                    <input type="text" name="description"
                                           class="bg-mocono-gray border-none focus:border-none h-10 rounded text-sm 2xl:text-base w-full "
                                           id="description" value="Continue reading your articles with premium members">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p>Main color</p>
                                        <div class="flex items-center">
                                            <input readonly type="text" name="main_color"
                                                   class="bg-mocono-gray border-none focus:border-none h-10 rounded text-sm 2xl:text-base rounded-r-none w-full"
                                                   id="main-color" value="#000000">
                                            <div>
                                                <div class="h-10 w-10"><input type="color"
                                                                              id="main-color-picker" class="w-10 h-10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Accent color</p>
                                        <div class="flex">
                                            <input readonly type="text" name="accent_color"
                                                                 class="bg-mocono-gray border-none focus:border-none h-10 rounded text-sm 2xl:text-base rounded-r-none w-full"
                                                                 id="accent-color" value="#000000">
                                            <div>
                                                <div class="h-10 w-10"><input type="color" name=""
                                                                              id="accent-color-picker"
                                                                              class="w-10 h-10"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="grid xl:grid-cols-3 md:grid-cols-2 gap-4 mt-9">
                                <div class="w-full md:w-max">
                                    <p class="mb-1">Your logo</p>
                                    <div class="border w-full md:w-64 h-44 flex items-center justify-center flex-col">
                                        <input type="file" name="your_logo" id="" class="custom-file-input">
                                        <p class=" text-sm">JPG or PNG, up to 10MB </p>
                                    </div>
                                </div>
                                <div class="w-full md:w-max">
                                    <p class="mb-1">Desktop screenshot</p>
                                    <div class="border w-full md:w-64 h-44 flex items-center justify-center flex-col">
                                        <input type="file" name="desktop_screenshot" id="" class="custom-file-input">
                                        <p class=" text-sm">JPG or PNG, up to 10MB </p>
                                    </div>
                                </div>
                                <div class="w-full md:w-max">
                                    <p class="mb-1">Mobile screenshot</p>
                                    <div class="border w-full md:w-64 h-44 flex items-center justify-center flex-col">
                                        <input type="file" name="mobile_screenshot" id="" class="custom-file-input">
                                        <p class=" text-sm">JPG or PNG, up to 10MB </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 w-11/12 lg:w-144 xl:w-159 mx-auto flex justify-center md:justify-end">
                            <button @click="activeTab = 2" type="button" class="w-40 h-12 bg-mocono-200 text-white rounded mb-14 text-sm 2xl:text-base" id="savebtn2">
                                Save and continue
                            </button>
                        </div>
                        <div class="w-11/12 lg:w-144 xl:w-159 mx-auto  mb-7">
                            <p class="mt-11 text-center">Preview your paywall</p>
                        </div>
                        <section class="bgDark hidden md:flex justify-center pb-9 ">
                            <div class="w-144 h-141.5  mt-7">
                                <div class="w-full h-2 bg-black rounded-t-md"></div>
                                <div class="bg-white px-10 py-8 rounded-b-md">
                                    <div class="flex justify-between">
                                        <img src="../img/economist-logo.png" alt="" srcset="">
                                        <p class="font-medium">You have read 5/5 free articles</p>
                                    </div>
                                    <div class="flex flex-col items-center mt-4">
                                        <img src="../img/package-placeholder.png" alt="" srcset="">
                                        <h1 class="font-bold text-3xl mt-2">Get unlimited access</h1>
                                        <p>Continue reading your article with a premium membership</p>
                                        <p class="text-lg px-3 py-1 bg-green-600 font-semibold text-white rounded-full mt-2">
                                            30 days free trial</p>
                                    </div>
                                    <div class="mt-12 flex justify-between items-center pb-4  border-b">
                                        <div class="flex items-center ">
                                            <div class="mr-4">
                                                <p class="font-bold">Monthly</p>
                                            </div>
                                            <div class="flex items-center mx-4">
                                                <p>1 person</p>
                                                <button class="text-black text-3xl focus:outline-none mx-3"
                                                        aria-label="User dropdown button"><i
                                                            class="fal fa-angle-down"></i></button>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mx-4">
                                                <p class="font-medium">£5 / month</p>
                                            </div>
                                            <div class="mx-4">
                                                <button class="bg-black text-white h-12 w-20 rounded-md">Sign up
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center pb-4  border-b">
                                        <div class="flex items-center ">
                                            <div class="mr-4">
                                                <p class="font-bold">Yearly</p>
                                            </div>
                                            <div class="flex items-center mx-4">
                                                <p>1 person</p>
                                                <button class="text-black text-3xl focus:outline-none mx-3"
                                                        aria-label="User dropdown button"><i
                                                            class="fal fa-angle-down"></i></button>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="font-normal italic">Save 16.6%</p>
                                            <div class="mx-4">
                                                <p class="font-medium">£5 / month</p>
                                            </div>
                                            <div class="mx-4">
                                                <button class="bg-black text-white h-12 w-20 rounded-md">Sign up
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mt-5">
                                        <a href="" class="underline text-gray-600 font-medium">No, thanks</a>
                                        <a href="" class="underline text-gray-600 font-medium">I already have an
                                            account</a>
                                    </div>

                                </div>
                            </div>

                        </section>
                    </div>


                    <!-- ////////////////////////////////////////second tab ends //////////////////////////////////////////// -->
                    <!-- ////////////////////////////////////////Third tab starts //////////////////////////////////////////// -->
                    <div class="" x-show="activeTab===2">
                        <div class="py-6 px-3 sm:py-10 sm:px-14 w-11/12 lg:w-144 xl:w-159 bg-white mx-auto rounded shadow">
                            <div class="pb-32">
                                <div class="md:px-14">
                                    <div class="sm:mt-14 flex md:items-center justify-between pb-6 border-b flex-col md:flex-row">
                                        <div class="flex items-center">
                                            <button type="button" class="text-mocono-200 text-3xl focus:outline-none mx-3"
                                                    aria-label="User dropdown button"><i class="fal fa-angle-down"></i>
                                            </button>
                                            <p class="font-medium lg:text-lg ml-3 sm:ml-5">Download and install the
                                                plugin</p>
                                        </div>
                                        <div class="flex items-center px-14 py-4 md:px-0 md:py-0">
                                            <img src="{{asset('assets/img/completed.png')}}" alt="" srcset="" class="h-6 w-6">
                                            <p class="font-medium ml-2">Complete</p>
                                        </div>
                                    </div>
                                    <div x-data="{selected:2}">
                                        <ul class="shadow-box">
                                            <li class="relative mt-5 pb-6 border-b">
                                                <div class="flex items-center">
                                                    <button ype="button" class="text-mocono-200 text-3xl focus:outline-none mx-3"
                                                            aria-label="User dropdown button"
                                                            @click="selected !== 1 ? selected = 1 : selected = null"
                                                            id="accordion-btn"><i
                                                                class="fal fa-angle-down transition-transform duration-500"
                                                                id="angle-down-icon"></i></button>
                                                    <p class="font-medium ml-3 sm:ml-5 lg:text-lg">Stripe
                                                        Integration</p>
                                                    <span class="ico-plus"></span>
                                                </div>
                                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 md:pl-16 pl-2"
                                                     x-ref="container1"
                                                     x-bind:style="selected == 1 ? 'min-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                                    <div class="">
                                                        <p class="text-sm">We use Stripe for handling payments</p>
                                                    </div>
                                                    <div class="flex items-center mt-6">
                                                        <div>
                                                            <div class="w-6 h-6 rounded-full bg-mocono-unactive flex justify-center items-center text-white font-medium ">
                                                                1
                                                            </div>
                                                        </div>
                                                        <p class="ml-4">Create a Stripe account <a href=""
                                                                                                   class="font-medium text-mocono-200 underline">https://stripe.com/gb</a>
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center mt-4">
                                                        <div>
                                                            <div class="w-6 h-6 rounded-full bg-mocono-unactive flex justify-center items-center text-white font-medium ">
                                                                2
                                                            </div>
                                                        </div>
                                                        <p class="ml-4">Copy and paste your payment API key</p>
                                                    </div>
                                                    <div class="ml-1 md:ml-9 mt-6 ">
                                                        <p class="">API Key</p>
                                                        <div class="flex md:items-center mt-2 flex-col md:flex-row">
                                                            <input type="text" name="stripe_api_key"
                                                                   class="bg-mocono-gray border-none focus:border-none h-10 rounded font-medium w-96 text-base"
                                                                   id="main-color" value="#000000">
                                                            <div class="flex items-center mt-2 md:mt-0">
                                                                <button class="bg-mocono-200 w-20 h-10 text-white rounded-md md:ml-2">
                                                                    Save
                                                                </button>
                                                                <p class="ml-7"><a href=""
                                                                                   class="underline text-mocono-200 font-medium text-sm">Test
                                                                        Connection</a></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5">
                                                            <a href="" class="underline text-mocono-200 font-medium">How
                                                                to find your API key</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mt-6 flex items-center justify-between pb-6 border-b">
                                        <div class="flex items-center">
                                            <button ype="button" class="text-mocono-200 text-3xl focus:outline-none mx-3"
                                                    aria-label="User dropdown button"><i class="fal fa-angle-down"></i>
                                            </button>
                                            <p class="font-medium lg:text-lg ml-3 sm:ml-5">Mailchimp integration
                                                (optional)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 lg:w-144 xl:w-159 mx-auto flex justify-center md:justify-end mt-4 pb-4">
                            <button type="submit" class="h-12 bg-mocono-200 text-white text-medium rounded-md" style="width:9.43rem">
                                Save & Finish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        function setup() {
            return {
                activeTab: 0,
                memebershipTab: 0,
                tabs: [
                    "Memberships",
                    "Branding",
                    "Integration",
                ]
            };
        };
    </script>
@endsection
