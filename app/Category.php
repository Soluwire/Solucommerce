<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "categories";
    protected $fillable = [
        'category_name',
        'category_description'
    ];
    public function Products(){
        return $this->hasMany("App\Product","category_id","id");
    }
}
