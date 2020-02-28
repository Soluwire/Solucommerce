<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use \SoluHelpers\Cart\Cart;
class CartController extends Controller
{
    protected function VariantCart(Request $_request){
        $_request->validate([
            'variant_id' => "required",
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        if(Product::where("id",$_request->product_id)->exists()){
            $product = Product::where("id",$_request->product_id)->first();
            if($product->Variants()->where("id",$_request->variant_id)->exists()){
                $variant = $product->Variants()->where("id",$_request->variant_id)->get()->first();
                $price = $variant->variant_price;
                Cart::AddItem($variant->variant_product_code,$variant->variant_name,$_request->quantity,$price);
                return Response("Success",200);
            }   
        }
    }
    protected static function DeleteFromCart(Request $_request, String $product_code){
       $delete = Cart::DeleteItem($product_code);
       if($delete){
        //   TODO: Show fail
        return redirect()->back();
       }else{
        //  TODO:  Show success
        return redirect()->back();
       }
    }
}
