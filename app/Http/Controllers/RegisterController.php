<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\RegisterMail;

class RegisterController extends Controller
{
    protected function Register(Request $_request){
        $_request->validate([
            'forename' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password2' => 'required',
            'phone' => 'required'

        ]);

        if($_request->password == $_request->password2){
            $users = User::all();
            if(count($users)>0){
                // We have to loop over each one due to them being encrypted.
                foreach($users as $user){
                    if($user->email == $_request->email){
                        // Throw email exists
                        $_request->session()->flash("alert",["type" => "red", "message" => "Email already exists!"]);
                        return back();

                    }
                }
            }
            try { 
                \Stripe\Stripe::setApiKey(env("STRIPE_S_KEY"));
                
                \Stripe\Customer::create([
                    'description' => "customer for - " . env("APP_NAME"),
                    'email' => $_request->email,
                    'name' => $_request->forename . $_request->surname,
                    'phone' => $_request->phone
                  ]);

                $user = new User();
                $user->forename = $_request->forename;
                $user->surname = $_request->surname;
                $user->email = $_request->email;
                $user->phone_number = $_request->phone;
                $user->type = 2;

                $user->password = Hash::make($_request->password);
                $user->save();
                
                // Sent register email.
                Mail::to($_request->email)->send(new RegisterMail($_request->forename));

                \Auth::login($user);
                return redirect()->route('cart');
            }catch(\Exception $e){
                $_request->session()->flash("alert",["type" => "red", "message" => "Error registering. Please try again later!"]);
                return back();
            }
         
        }else{
            $_request->session()->flash("alert",["type" => "red", "message" => "Your passwords do not match!"]);
            return back();
        }
    }
}
