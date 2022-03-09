<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mocono</title>
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    {{-- <meta name="user-id" content="{{ auth()->user()->id }}">
    <meta name="membership-id" content="{{auth()->user()->membership }}">--}}
    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{'css/app.css'}}">--}}
    <link rel="stylesheet" href="{{asset('assets/dist/index.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/fontawesome.css')}}">
    <!-- <link rel="stylesheet" href="https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAUDngj0r21DKrl6VnPgdHAyDbWeFGxPUk"/> -->

<!-- <script src="https://apis.google.com/js/api.js"></script>   -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <style>
        .i-am-clicked {
            cursor: wait;
        }
    </style>


</head>
<body class="bg-mocono-100">
{{--{{dd(auth()->user())}}--}}
@if (Auth::check())
    <script>

            {{--localStorage.setItem('membershipId', '{{auth()->user()->membership}}' );--}}
        var userJson = '{!!json_encode([
               'isLoggedin' => true,
               'user' => auth()->user(),
               'type' => auth()->user()->type,
           ])!!}'
        window.Laravel = JSON.parse(userJson);
    </script>

    @if(isset(auth()->user()->roles) && !empty(auth()->user()->roles) && count(auth()->user()->roles)>0)
    <script>
        localStorage.setItem('userTypeRole', '{{auth()->user()->roles[0]->name}}' );
    </script>
        @else
        <script>
            localStorage.setItem('userTypeRole', 'user' );
        </script>
        @endif
@else
    <script>
        window.Laravel = '{!!json_encode([
                'isLoggedin' => false
            ])!!}'
    </script>
@endif
<div id="app">
    {{--<sidebar-component></sidebar-component>--}}
    {{--<router-view></router-view>--}}

    <main class="3xl:mr-32 3xl:pt-2 2xl:mr-24 mx-5" >
        @if(auth()->check())
            @if(auth()->user()->type==0)

                <admin-sidebar-component></admin-sidebar-component>
                <section class="ml-20 lg:ml-60 xl:ml-60 bg-mocono-gray mt-4 rounded-t-3xl">
                    <admin-header-view-component></admin-header-view-component>
                    <router-view></router-view>
                </section>
            @else

                <div class="flex">
                    <div>
                        <sidebar-component></sidebar-component>
                    </div>
                    <div class="mt-20 lg:mt-2 w-full bg-mocono-gray rounded-t-3xl px-6 sm:px-12 py-6 relative  ">
                        <header-view-component></header-view-component>
                        <router-view></router-view>
                    </div>
                </div>
            @endif
        @else
            <router-view></router-view>
        @endif
    </main>

</div>
    <script>
    var base_url = '{{url('/')}}';
</script>
<script src="{{'/js/app.js'}}"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script src="{{asset('assets/js/sidebar.js')}}" async></script>
<script src="{{asset('assets/js/outclick.min.js')}}"></script>
{{--date picker for ab test result page --}}
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>

<script src="{{asset('assets/js/custom.js')}}"></script>



</body>
</html>
