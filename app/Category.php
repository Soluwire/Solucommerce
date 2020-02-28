<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function Products(){
        return $this->hasMany("App\Product","category_id","id");
    }
}
