<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected function Login(Request $_request){
        $_request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $users = User::get();
        foreach($users as $user){
            if($user->email==$_request->email){
                if (Hash::check($_request->password, $user->password)){
                    \Auth::login($user);
                    return back();
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
}
