@extends("layout.base")
@section('base.title')
Register
@endsection

@section('base.content')
<div class="container mt-2">
@if(Session::has("alert"))
    <div class="w-full bg-{{ Session::get("alert")['type']}}-300 border-{{Session::get("alert")['type']}}-400 p-2 border-l-2">
        {{ Session::get("alert")['message']}}
    </div>
@endif
    <div class="p-2 shadow">
        <h1>Register</h1>
        <p>Don't have an account? Feel free to register below for an account with {{env('APP_NAME')}}</p>
       <form action="{{route('register.form')}}" method="POST">
        {{csrf_field()}}
        <label for="forename" class="p-2 font-bold text-sm">Forename</label>
        <input type="text" placeholder="Forename" name="forename" class="block p-2 border-b-2 border-black">

        <label for="surname" class="p-2 font-bold text-sm">Surname</label>
        <input type="text" placeholder="Surname" name="surname" class="block p-2 border-b-2 border-black">

        <label for="email" class="p-2 font-bold text-sm">Email</label>
        <input type="email" placeholder="jane.doe@email.com" name="email"  class="block p-2 border-black border-b-2">
        
        <label for="phone" class="p-2 font-bold text-sm">Telephone</label>
        <input type="tel" placeholder="01213392222" name="phone"  class="block p-2 border-black border-b-2">
        
        <label for="password" class="p-2 font-bold text-sm">Password</label>
        <input type="password" placeholder="Password" name="password"  class="block p-2 border-black border-b-2">

        <label for="password" class="p-2 font-bold text-sm">Re enter password</label>
        <input type="password" placeholder="Re-enter password" name="password2"  class="block p-2 border-black border-b-2">
        <button type="submit" class="bg-blue-300 p-2 mt-2">Register</button>
        <a class="block text-blue-700 mt-2" href="{{route('login')}}">Already have an account? Log in here</a>
       </form>
    </div>
</div>
@endsection
