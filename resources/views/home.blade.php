@extends("layout.base")
@section('base.title')
Home
@endsection

@section('base.meta')
<meta name="keywords" content="{{env('APP_NAME')}}">
<meta name="description" content="{{env('APP_NAME')}}">
@endsection
@section('base.content')
<section id="welcome">
    <h1>Welcome to {{env('APP_NAME')}}</h1>
</section>
<h3>Check out some of our products below</h3>
<section id="categories" class="flex flex-row">
    @foreach($categories as $category)
    <a href="{{route('viewcategory',UrlHelp::ToUrl($category->category_name))}}">
        <div class="shadow max-w-xs py-4 px-6">
            {{$category->category_name}}
            @if($category->Products()->first()->Variants()->exists())
            <img src="{{$category->Products()->first()->Variants()->first()->Picture()->first()->path}}" alt="">
            @endif
        </div>
    </a>
    @endforeach
</section>

@endsection