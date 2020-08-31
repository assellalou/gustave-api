<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Teacher
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
        try {
            if ($this->guard()->user()->is_teacher == 1) {
                return $next($request);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function guard()
    {
        return Auth::guard();
    }
}
