<?php

namespace App\Http\Middleware;

use Closure;


use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->check() && $request->user()->role >=1) {
            return $next($request);
        } else {
            $message = ["mesage"=> "Permission Denied"];
            return response($message, 401);
        }
        return $next($request);
    }
}
