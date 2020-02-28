<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use SoluHelpers\Url\StringToUrl;

class ProductController extends Controller
{
   protected function ViewProduct(Request $_request, String $category_name, String $product_name){
    try{
        $category_name = StringToUrl::UrlToString($category_name);
        $product_name = StringToUrl::UrlToString($product_name);

        if(Product::where('product_name',"like",$product_name)->exists()){
            $product = Product::where('product_name',"like",$product_name)->get()->first();
            
            $split = explode($product_name," ");
            $prods = [];

            // Foreach word in the product, see if we can find related products.
            foreach($split as $word){
                $related = Product::where('product_name',"like","%" .$word."%")->where('id','!=',$product->id)->get();
        
                array_push($prods,$related);
            }
            
            $prods = collect($prods)->unique('product_code');
            
            if($product->Category()->get()->first()->category_name){
                return view('products.product')->with(array_merge([
                    'product'=> $product,
                    'related'=> $prods
                ]));

            }else{
                abort('404',"This product does not belong to this category boss.");

            }

        }else{
            abort('404',"Unable to find that particular category");
        }
    }catch(\Exception $e){
        abort('404',"Unable to find that particular category, or DB down.");
    }

 }
   }

