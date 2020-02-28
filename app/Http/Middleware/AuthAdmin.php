<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has("admin")){
            if($request->session()->get("admin") == true){

            }else{
                return back();
            }
        }else{
            return back();
        }
        return $next($request);
    }
}
