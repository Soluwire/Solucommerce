<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env("APP_NAME")}} | Admin </title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    </head>
    <body>
       <main class="d-flex justify-center h-full w-full">
           <div class="bg-gray-500 h-full flex justify-center items-center">
               <div class="lg:w-1/2 sm:w-full md:w:-full w-full flex items-center self-center content-center justify-center flex-col p-10 bg-white">
                <h1>Please change the default administrator login.</h1>
                <b>You must change this by default, you can't continue otherwise. This will prevent any people accessing the backend without authentication.</b>
                <form class="w-full" action="{{route('admin.changecredentials')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @if(Session::has("alert"))
                            <div class="w-full bg-{{ Session::get("alert")['type']}}-300 border-{{Session::get("alert")['type']}}-400 p-2 border-l-2">
                                {{ Session::get("alert")['message']}}
                            </div>
                        @endif
                        <div class="w-full">
                                <label for="email" class="block">Administrators Email</label>
                                <input type="email" class="w-full border-2 m-2 p-2 rounded"  name="ademail"> 
                            </div>
                            <div  class="w-full">
                                <label for="password" class="block">New Password</label>
                                <input type="password" class="w-full border-2 m-2 p-2 rounded" name="adpassword">
                            </div>
                            <div  class="w-full">
                                <button class="bg-blue-400 p-2 rounded text-white shadow-md ml-2">
                                    Submit new details
                                </button>
                            </div>
                </form>
               </div>
               
           </div>
           <footer class="container m-auto py-3 absolute bottom-0 ml-2 text-white">
                Powered by SoluCommerce
            </footer>
       </main>
    </body>
</html>
