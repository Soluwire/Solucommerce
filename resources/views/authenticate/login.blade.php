@extends("layout.base")
@section('base.title')
Login
@endsection

@section('base.content')
<div class="container mt-2">
    @if(Session::has("alert"))
    <div class="w-full bg-{{ Session::get("alert")['type']}}-300 border-{{Session::get("alert")['type']}}-400 p-2 border-l-2">
        {{ Session::get("alert")['message']}}
    </div>
@endif
    <div class="p-2 shadow">
        <h1>Login</h1>
        <p>Already have an account? Feel free to login below.</p>
        <form action="{{route('login.form')}}" method="POST">
            {{csrf_field()}}
            <label for="email" class="p-2 font-bold text-sm">Email</label>
            <input type="email" name="email" placeholder="jane.doe@email.com" class="block p-2 border-black border-b-2">
            <label for="password" class="p-2 font-bold text-sm">Password</label>
            <input type="password" name="password" placeholder="Password" class="block p-2 border-b-2 border-black">
            <button type="submit" class="bg-blue-300 p-2 mt-2">Proceed to login</button>
        </form>
        <a class="block text-blue-700 mt-2" href="{{route('register')}}">Register for an account</a>
    </div>
</div>
@endsection
