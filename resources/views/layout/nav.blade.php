<nav class="flex w-100 bg-blue-600 h-24 text-white">
    <div class="w-1/6 text-center relative">
        <a href="{{route('home')}}"><img class="absolute h-full object-contain logo w-100" src="{{asset('images/logo.png')}}" alt="{{env("APP_NAME")}} logo"></a>
    </div>
    <div class="w-1/2 flex flex-row xl:visible lg:visible md:visible sm:invisible invisible">
        @foreach($menuitems ?? '' as $menuitem)
        
            @if($menuitem->menu_item_name=="Products")
            <div class="h-full flex items-center mx-3 has-sub-menu">

                    <p>{{$menuitem->menu_item_name}}</p>
                    <ul class="sub-menu shadow">
                        @foreach($categories as $category)
                        <li class="sub-category text-black">
                            <a href="{{route('viewcategory',UrlHelp::ToUrl($category->category_name))}}">{{$category->category_name}}
                                @if($category->products()->exists())
                                <ul class="sub-menu shadow">
                                    @foreach($category->products()->get() as $product)
                                    <a href="{{route('viewproduct',[UrlHelp::ToUrl($category->category_name),UrlHelp::ToUrl($product->product_name)])}}"> <li>{{$product->product_name}}</li></a>
                                    @endforeach
                                </ul>
                                @endif
                            </a>
                            
                        </li>
                        @endforeach
                     
                    </ul>
           
            </div>
            @else
            <div class="h-full flex items-center mx-3">
                @if($menuitem->menu_item_name=="Home")
                <a href="/"  class="menu-item">{{$menuitem->menu_item_name}}</a>
                @else
                    @if($menuitem->page_id!==null)
                    <a href="/{{route('page',$menuitem->Page()->first()->page_name)}}">{{$menuitem->menu_item_name}}</a>
                    @else
                    
                    <a href="/{{strtolower($menuitem->menu_item_name)}}"  class="w-full h-full menu-item">{{$menuitem->menu_item_name}}</a>
                    @endif
                @endif
            </div>
            @endif
        @endforeach
    </div>
    <div class="w-1/4 self-center xl:visible lg:visible md:visible sm:invisible invisible">
    @if(!Auth::check())
        <a href="{{route('register')}}">
            Register
        </a>
        <a href="{{route('login')}}">
            Login
        </a>
        @else
        <p>Welcome <b> {{Auth::user()->forename}}</b></p>
    @endif
    <a href="{{route('cart')}}"> 
        <div class="cart">
        <i class="fas fa-shopping-cart"></i>
            <small>{{$currency}}{{Cart::CartTotal()}}</small>
            <small>{{Cart::Count()}} items in cart</small>
        </div>
    </a>
    @if(Auth::check())
    <a href="{{route('logout')}}">Logout</a>
    @endif
    </div>
    <div class="p-3 text-3xl xl:invisible lg:invisible md:invisible sm:visible visible flex items-center">
        <i class="fas fa-bars" id="mobile-menu"></i>
    </div>
</nav>
<div id="mobile-nav" class="text-2xl text-center bg-gray-200 p-2">
    @foreach($menuitems ?? '' as $menuitem)
        
    @if($menuitem->menu_item_name=="Products")
    <div class="h-full flex items-center mx-3 flex-wrap border-b-2 border-black">
        <a href="" class="w-full h-full border-b-2 border-black">{{$menuitem->menu_item_name}}
                @foreach($categories as $category)
                    <a  class="w-full h-full border-b-2 border-black" href="{{route('viewcategory',UrlHelp::ToUrl($category->category_name))}}">{{$category->category_name}}
                        @if($category->products()->exists())
                            @foreach($category->products()->get() as $product)
                           <a   class="w-full h-full" href="{{route('viewproduct',[UrlHelp::ToUrl($category->category_name),UrlHelp::ToUrl($product->product_name)])}}"> {{$product->product_name}}</a>
                            @endforeach
                        @endif
                    </a>
                    
                @endforeach
        </a>
   
    </div>
    @else
    <div class="h-full flex items-center mx-3 border-b-2 border-black">
        @if($menuitem->menu_item_name=="Home")
        <a href="/"  class="w-full h-full ">{{$menuitem->menu_item_name}}</a>
        @else
            @if($menuitem->page_id!==null)
            <a href="/{{route('page',$menuitem->Page()->first()->page_name)}}"  class="w-full h-full">{{$menuitem->menu_item_name}}</a>
            @else
            
            <a href="/{{strtolower($menuitem->menu_item_name)}}"  class="w-full h-full">{{$menuitem->menu_item_name}}</a>
            @endif
        @endif
    </div>
    @endif
@endforeach
</div>