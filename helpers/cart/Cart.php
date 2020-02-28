<?php
namespace SoluHelpers\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Cart { 
    
   public static function CreateCart(){
    if(!Session::has("cart")){
        Session::put("cart",[]);
    }
    
}
   public static function AddItem(String $productcode, String $item,Int $qty, String $price): Bool{
    $cart = Session::get("cart");

    $checkedcart = self::CheckItemNotExist($cart,$item,$qty,$price);
    
    if($checkedcart->edited==false){
     array_push($cart,(object)["product_code" => $productcode, "name" => $item, "qty" => $qty, "price" => $price]);
     Session::put("cart",$cart);
    }else{
     Session::put("cart",$checkedcart->cart);

    }
    return true;
   }
   
   protected static function CheckItemNotExist(Array $cart,String $item,Int $qty, String $price): Object{
    $itemexists = false;
    foreach($cart as $row){
        if($row->name == $item){
            if($qty>0){
                $row->qty+=$qty;
            }
            $itemexists = true;
        }
    }
    return (object)['cart' => $cart, 'edited' => $itemexists];
   }

   public static function DeleteItem(String $productcode){
    $cart = Session::get("cart");
    foreach($cart as $key =>  $row){
        if($row->product_code == $productcode){
            unset($cart[$key]);
        }
    }
    Session::put("cart",$cart);
    return True;
   }

   public static function CartTotal(): String{
    $total = 0;
    $cart = Session::get("cart");
    foreach($cart as $row){
        $total+= ($row->price * $row->qty);
    }
    return number_format((float)$total,2);
}


 public static function Count(): Int{
    $total = 0;
    $cart = Session::get("cart");
    foreach($cart as $row){

        $total+=$row->qty;
    }
    return $total;
 }


}
?>