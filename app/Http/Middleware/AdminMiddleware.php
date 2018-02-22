<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
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
        //定义后台用户守卫
        if(!Auth::guard('admin')->check()){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
