@extends("layout.base")
@section('base.title')
Cart
@endsection

@section('base.content')
<div class="container">
    <h1>Cart</h1>
@if(count(Session::get("cart"))==0)
<p class="font-bold">No items to show in your cart.. Perhaps add some?</p>
@else
<table class="text-left w-full border-collapse">
    <thead>
        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Product Code</th>
        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Item</th>
        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Quantity</th>
        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Price</th>
        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
    </thead>
    <tbody>
        @foreach (Session::get("cart") as $item)
            <tr>
                <td class="py-4 px-6 border-b border-grey-light">{{$item->product_code}}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{$item->name}}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{$item->qty}}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{$currency}} {{$item->price}}</td>
                <td class="py-4 px-6 border-b border-grey-light"><a href="{{route('cartdelete',[$item->product_code])}}"><button class="bg-red-700 p-2 text-white"><i class="fas fa-trash"></i></button></a></td>
            </tr>
        @endforeach

    </tbody>
</table>

<div class="clearfix">
    <div class="float-right mt-3 py-2 px-3 text-center">
        <h5>Cart Total</h5> <b class="text-2xl">{{$currency}}{{Cart::CartTotal()}}</b>
        @if(Cart::Count()>0)
        <a href="{{route('checkout')}}"><button class="block py-2 px-4 bg-blue-500 rounded text-white">Proceed to checkout</button></a>
        @endif
    </div>
</div>
</div>
@endif
@endsection