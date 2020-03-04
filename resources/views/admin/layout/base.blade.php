<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{env("APP_NAME")}} | Admin @yield("base.title")</title>
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body>
      <main class="w-full h-full flex">
        <div id="dashboard" class="w-full h-full">
            <dashboard></dashboard>
        </div>
      </main>      
    <script src="{{mix("js/dashboard.js")}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </body>
</html>
