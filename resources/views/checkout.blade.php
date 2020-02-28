@extends("layout.base")
@section('base.title')
Checkout
@endsection
@section('base.css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('base.meta')
<meta name="keywords" content="checkout,{{env('APP_NAME')}}">
<meta name="description" content="Checkout">
@endsection

@section('base.content')
<div class="container">
    <div id="checkout">
    <Checkout :cart="{{json_encode(Session::get("cart"))}}" :stripekey="{{json_encode(env('STRIPE_KEY'))}}" :carttotal="{{json_encode(Cart::CartTotal())}}" :stripeintent="{{json_encode($intent)}}"></Checkout>
    </div>
</div>
@endsection

@section('base.js')
<script src="{{mix("/js/checkout.js")}}"></script>
@endsection