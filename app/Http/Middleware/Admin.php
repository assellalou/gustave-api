<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
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
        if ($this->guard()->user()->is_admin == 1) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function guard()
    {
        return Auth::guard();
    }
}
