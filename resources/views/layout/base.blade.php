<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="index, follow">
        <meta name="copyright" content="{{env("APP_NAME")}}, Solucommerce">
        @yield('base.meta')
        <title>{{env("APP_NAME")}} | @yield("base.title")</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        @yield('base.css')
    </head>
    <body>
    @include('layout.nav')
    <main class="container m-auto" id="main">
        @yield('base.content')
    </main>
    <footer class="p-3 bg-blue-900 text-white block">
        &copy {{env("APP_NAME")}}  {{Date("Y")}} - Powered By Solucommerce
    </footer>
    <script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('/js/app.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>

    @yield('base.js')
    </body>
</html>
