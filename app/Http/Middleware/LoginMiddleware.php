<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        if(session('id')){
             return $next($request);
         }else{
            return  redirect('/admin/login')->with('error','亲,您还没有登陆呢');
         }
       
    }
}
