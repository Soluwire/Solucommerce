<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
class PageController extends Controller
{
    protected function GetPage(Request $_request, String $_pagename){
        if(Page::where('page_name',$_pagename)->exists()){
            $page = Page::where('page_name',$_pagename)->first();
            return view('page')->with('page',$page);
        }else{
            abort(404,"No page found");
        }
    }
}
