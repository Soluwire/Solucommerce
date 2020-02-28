<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
 protected $table = "variants";

 public function Product(){
     return $this->hasOne("App\Product","id","product_id");
 }

 public function Picture(){
     return $this->hasMany("App\Picture","variant_id","id");
 }
}
