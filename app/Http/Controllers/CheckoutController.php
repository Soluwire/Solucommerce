<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\OrderJob;
use Auth;
class CheckoutController extends Controller
{
    protected function View(){
        if(\Cart::Count()>0){
            \Stripe\Stripe::setApiKey(env("STRIPE_S_KEY"));
            $intent = \Stripe\PaymentIntent::create([
                'amount' => (\Cart::CartTotal() * 100),
                'currency' => env("STRIPE_CURRENCY"),
            ]);
            return view('checkout')->with("intent",$intent->client_secret);    
        }else {
            return route('cart');
        }
    }

    protected function HandlePayment(Request $_request){
        $_request->validate([
            'deliveryaddress' => 'required',
            'billingaddress' => 'required'
        ]);
        OrderJob::dispatch($_request->session()->get("cart"),\Cart::CartTotal(),Auth::user()->email,Auth::user()->forename,$_request->billingaddress,$_request->deliveryaddress);
        return Response("Success",200);
    }
}
