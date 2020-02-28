<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function Variants(){
        return $this->hasMany("App\Variant","product_id","id");
    }
    public function Category(){
        return $this->hasOne("App\Category","id","category_id");
    }
}
