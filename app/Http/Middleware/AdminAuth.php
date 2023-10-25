<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\Authorizable; 
class AdminAuth
{
    use Authorizable;   
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // dd("ok");
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(Auth::check() && Auth::user()->role==1){

            return $next($request);
        }
        return redirect()->route('loginadmin');
        
    }
}
