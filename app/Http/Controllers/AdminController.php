<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User,MenuItem};
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   protected function Login(Request $_request){
       $_request->validate([
           'email' => 'required',
           'password' => 'required'
       ]);
        $users = User::all();
        foreach($users as $user){
            if($user->email == $_request->email && $user->type==1){
                if(Hash::check($_request->password,$user->password)){
                    if($user->email=="admin@domain.com"){
                        // If it's the init user, get user to change
                    return redirect()->route("admin.credentials");
                    }else{
                    $_request->session()->put("admin",true);
                    return redirect()->route("admin.dashboard");

                    }
                }else{
                    $_request->session()->flash("alert",["type" => "red", "message" => "Incorrect login info!"]);
                    return back();
                }
            }else{
                $_request->session()->flash("alert",["type" => "red", "message" => "Incorrect login info!"]);
                return back();
            }
        }

   }

   protected function Dashboard(Request $_request){
       return view("admin.dashboard");
   }

   protected function ChangeCredentials(Request $_request){
    $users = User::where('type',1)->get();
    foreach($users as $user){
        if($user->email=="admin@domail.com"){
            return view("admin.credentials");

        }
    }
    return redirect()->route('home');
   }
   protected function ChangeCredentialsHandle(Request $_request){
       $_request->validate([
           'ademail' => 'required',
           'adpassword' => 'required'
       ]);
        // Admin will always be id 1, as inserted in migration.
        $users = User::all();
        foreach($users as $user){
            if($user->email == "admin@domain.com"){
                $user->email = $_request->ademail;
                $user->password = Hash::make($_request->adpassword);
                $user->update();
                $_request->session()->flash("alert",["type" => "green", "message" => "Successfully updated admin login! Please login with your new details."]);
                 return redirect()->route('admin.login');
            }else{
                return redirect()->route('home');
            }
        }
      
   }

}
