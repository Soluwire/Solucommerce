<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{MenuItem,Product,Category,Variant,Picture,Page};
use \SoluHelpers\Api\ApiResponses;
use App\Http\Resources\{VariantResource,ProductResource};
class APIController extends Controller
{
    protected function MenuItems(){
        $menu = MenuItem::orderBy('menu_order')->get();
        return json_encode($menu);
    }
    protected function PostMenuItem(Request $_request){
       $_request->validate(['menuitem' => 'required', 'selectedpage' => 'nullable']);
       
       try { 
        $menuitem = MenuItem::latest()->first();

        $neworder = (int)$menuitem->menu_order + 1;
        $menuitem = new MenuItem();
        $menuitem->menu_order = $neworder;
        $menuitem->menu_item_name = $_request->menuitem;
        if(isset($_request->selectedpage)){
        $menuitem->page_id = $_request->selectedpage;
        }
        $menuitem->save();
        return ApiResponses::success();
       }catch(\Exception $e){
        return ApiResponses::fail();
       }

    }
    protected function UpdateMenuItems(Request $_request){
        $_request->validate(['menuitems' => 'required']);
        foreach($_request->menuitems as $key => $menuitem){
            $key = (int)$key+1;
                try{
                    if(MenuItem::where("id",$menuitem['id'])->where("menu_item_name",$menuitem['menu_item_name'])->exists()){
                        $menuitem = MenuItem::where("id",$menuitem['id'])->where("menu_item_name",$menuitem['menu_item_name'])->first();
                        $menuitem->menu_order = $key;
                        $menuitem->save();
                      
                    }else{
        
                    }
                }catch(\Exception $e){
                    return ApiResponses::fail();

                }
          
        }
        return ApiResponses::success();

    }

   protected function GetProducts(Request $_request){
       $prods = ProductResource::collection(Product::All());
       return $prods;
   }


   protected function GetCategories(Request $_request){
    $categories = Category::All();
    return $categories;
}
    protected function PostCategory(Request $_request){
        $_request->validate([
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ]);

       try {
        $category = new Category();
        $category->category_name = $_request->categoryName;
        $category->category_description = $_request->categoryDescription;
        $category->save();
        return ApiResponses::success();
       }catch(\Exception $e){
        return ApiResponses::fail();
       }
    }
    protected function PostProduct(Request $_request){
        $_request->validate([
            'productCode' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productDescription' => 'required',
            'productCategory' => 'required',
            'productHasVariants' => 'required']);

        try {
            $product = new Product();
            $product->product_code = $_request->productCode;
            $product->product_name = $_request->productName;
            $product->product_description = $_request->productDescription;
            $product->product_price = $_request->productPrice;
            $product->category_id = $_request->productCategory;
            $product->has_variants = $_request->productHasVariants;
            $product->save();
            
            return ApiResponses::success();
           }catch(\Exception $e){
            return ApiResponses::fail();
           }
    }
    protected function GetVariants(Request $_request){
        $variants = VariantResource::collection(Variant::all());
        return $variants;
    }
    protected function PostVariants(Request $_request){
        $_request->validate([
            'variantCode' => 'required',
            'variantDescription' => 'required',
            'variantName' => 'required',
            'variantPrice' => 'required',
            'images' => 'required' ]);


            try{
     
                $variant = new Variant();
                $variant->variant_type = 1;
                $variant->variant_product_code = $_request->variantCode;
                $variant->variant_name = $_request->variantName;
                $variant->variant_description = $_request->variantDescription;
                $variant->variant_price = $_request->variantPrice;
                $variant->product_id = $_request->variantProduct;
                $variant->variant_stock = $_request->variantStock;
                $variant->save();

            foreach($_request->images as $key => $image){
                $imgty = explode(',', $image);
                $subim =substr($imgty[0], 11);
                $type = explode(';', $subim);
                file_put_contents("./images/" . strtolower($_request->variantName) . "-" . $key . "." .$type[0], file_get_contents($image));
                

               try {
                $picture = new Picture();
                $picture->variant_id =  $variant->id;
                $picture->path = (String) "/images/" . strtolower($_request->variantName) . "-" . $key . "." .$type[0];
                $picture->Save();
               }catch(\Exception $e){
                // Log here.
               }
               
            }
                return ApiResponses::success();
            }catch(\Exception $e){
                return $e;

            }

    }

    protected function GetPages(Request $_request){
        $pages = Page::all();
        return $pages;
    }

    protected function PostPage(Request $_request){
        $_request->validate([
            'pageid' => 'required',
            'html' => 'required'
        ]);

        if(Page::where('id',$_request->pageid)){

            $page = Page::where('id',$_request->pageid)->first();
            $page->page_html = $_request->html;
            $page->update();
            return ApiResponses::success();
        }else {
            return ApiResponses::fail();
        }
    }
    protected function AddPage(Request $_request){
        $_request->validate([
            'pagename' => 'required'
        ]);
       try {
        $page = new Page();
        $page->page_name = $_request->pagename;
        $page->page_html = "";
        $page->save();
        return ApiResponses::success();
        }catch(\Exception $e){
            return ApiResponses::fail();

    }

    }


    protected function DeleteCategory(Request $_request, String $_id){
        try {
        Category::where('id',$_id)->first()->delete();
         return ApiResponses::success();
    }catch(\Exception $e){
        return ApiResponses::fail();
    }   

    }

    protected function UpdateCategory(Request $_request){
        $_request->validate([
            'id' => 'required',
            'category_name' => 'required',
            'category_description' => 'required'
        ]);
        try {
        $category = Category::where('id', $_request->id)->first();
        $category->category_name =  $_request->category_name;
        $category->category_description =  $_request->category_description;
        $category->update();
        return ApiResponses::success();

    }catch(\Exception $e){
        return ApiResponses::fail();
    }   
    
}
protected function DeleteProduct(Request $_request, String $_id){
    try {
    Product::where('id',$_id)->first()->delete();
     return ApiResponses::success();
}catch(\Exception $e){
    return ApiResponses::fail();
}   

}

protected function UpdateProduct(Request $_request){
    $_request->validate([
        'product' => 'required'
    ]);
    try {
    $product = Product::where('id', $_request->product['id'])->first();
    $product->product_code =  $_request->product['product_code'];
    $product->product_name =  $_request->product['product_name'];
    $product->product_description =  $_request->product['product_description'];
    $product->category_id =  $_request->product['category_id'];
    $product->update();
    return ApiResponses::success();

}catch(\Exception $e){
    return ApiResponses::fail();
}   


}
protected function DeletePage(Request $_request, String $_id){
    try {
    Page::where('id',$_id)->first()->delete();
     return ApiResponses::success();
}catch(\Exception $e){
    return ApiResponses::fail();
}   

}
protected function DeleteVariant(Request $_request, String $_id){
    try {
    Variant::where('id',$_id)->first()->delete();
     return ApiResponses::success();
}catch(\Exception $e){
    return ApiResponses::fail();
}   

}
protected function UpdateVariant(Request $_request){
    $_request->validate([
        'variant' => 'required'
    ]);
    // try {
    $variant = Variant::where('id', $_request->variant['id'])->first();
    $variant->variant_product_code =  $_request->variant['variant_product_code'];
    $variant->variant_name =  $_request->variant['variant_name'];
    $variant->variant_description =  $_request->variant['variant_description'];
    $variant->variant_price =  $_request->variant['variant_price'];
    $variant->variant_stock =  $_request->variant['variant_stock'];
    $variant->product_id =  $_request->variant['product_id'];
    $variant->update();
    return ApiResponses::success();

// }catch(\Exception $e){
//     return ApiResponses::fail();
// }   


}

}