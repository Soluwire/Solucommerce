<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function View(Request $_request){
        return view("home");
    }
}
