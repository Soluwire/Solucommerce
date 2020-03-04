@extends("layout.base")
@section('base.title')
{{$category->category_name}}
@endsection

@section('base.meta')
<meta name="keywords" content="{{$category->category_name}},{{env('APP_NAME')}}">
<meta name="description" content="{{$category->category_description}}">
<meta property="og:url"                content="{{URL::full()}}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="{{$category->category_name}}" />
<meta property="og:description"        content="{{$category->category_description}}" />
@if($category->Products()->first()->Variants()->exists())
<meta property="og:image" content="{{asset($category->Products()->first()->Variants()->first()->Picture()->first()->path)}}" />
@endif
@endsection
@section('base.content')
<section id="category" class="flex flex-col px-2">
   <h1>{{$category->category_name}}</h1>
   <p>{{$category->category_description}}</p>
   <p>Find a selection of {{$category->category_name}} below</p>
   <div>
      @if($category->products()->exists())
      <div class="flex xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col">
         @foreach($category->Products()->get() as $product)
         <a href="{{route('viewproduct',[UrlHelp::ToUrl($category->category_name),UrlHelp::ToUrl($product->product_name)])}}" class="px-3 py-6 border-1 shadow xl:w-1/3 lg:w-1/3 md:w-1/3 sm:w-full w-full mx-1 ">
            <p class="text-center text-2xl font-bold">{{$product->product_name}}</p>
               
            @if($product->price==0) 
               {{-- If it's a product with variants --}}
               <div class="fotorama">
                @if($category->Products()->first()->Variants()->exists())
               <img src="{{$product->Variants()->first()->Picture()->first()->path}}" alt="{{$product->product_name}}">
               @endif

               </div>
               
               @if($category->Products()->first()->Variants()->exists())
               <div class="text-center">
               <p>
               {{$product->Variants()->orderBy("variant_price")->get()->count()}} variants
               FROM <b class="text-blue-500 font-bold">{{$currency}}<span class="text-xl">{{$product->Variants()->orderBy("variant_price")->get()->first()->variant_price}}</span></b>
               </p>
               </div>
               @endif
               @else
               <p>{{$product->product_name}}</p>
               <p>{{$product->product_price}}</p>
               @endif
         </a>
         @endforeach
      </div>
      @else
      <b>Nothing here to show yet, we're building something..</b>
      @endif
   </div>
</section>
@endsection