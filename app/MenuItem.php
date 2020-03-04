<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
   use SoftDeletes;

   protected $table = "menuitems";

   public function Page(){
      return $this->hasOne('App\Page','id','page_id');
   }
}
