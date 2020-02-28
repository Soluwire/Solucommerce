<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
   protected $table = "menuitems";

   public function Page(){
      return $this->hasOne('App\Page','id','page_id');
   }
}
