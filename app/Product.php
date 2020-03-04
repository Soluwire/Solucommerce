<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    public function Variants(){
        return $this->hasMany("App\Variant","product_id","id");
    }
    public function Category(){
        return $this->hasOne("App\Category","id","category_id");
    }
}
