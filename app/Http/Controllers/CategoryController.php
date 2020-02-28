<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use SoluHelpers\Url\StringToUrl;
class CategoryController extends Controller
{
    protected function ViewCategory(Request $_request, String $category_name){
        try{
            $category_name = StringToUrl::UrlToString($category_name);
            if(Category::where('category_name',$category_name)->exists()){
                $cat = Category::where('category_name',$category_name)->get()->first();
                return view('products.category')->with('category',$cat);
    
            }else{
                abort('404',"Unable to find that particular category");
            }
        }catch(\Exception $e){
            abort('404',"Unable to find that particular category, or DB down.");
        }

     }
}
