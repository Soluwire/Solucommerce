<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use App\Paypal;
class PaypalController extends Controller
{
    public function ConfirmOrder(Request $_request) {

        $_request->validate([
            'orderId' => 'required'
        ]);

        $client = Paypal::client();
        $response = $client->execute(new OrdersGetRequest($_request->orderId));

        if($response->result->status=="COMPLETED"){
            return "success";
        };
    }
}