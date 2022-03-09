<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{'css/app.css'}}">--}}
    <link rel="stylesheet" href="{{asset('assets/dist/index.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/custom.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('style')
</head>
<body class="bg-mocono-100">
    <div id="app1">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{--<script src="{{'js/app.js'}}"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>--}}

    <script src="{{asset('assets/js/outclick.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    @yield('script')
</body>
</html>
