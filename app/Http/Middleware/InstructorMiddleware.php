<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InstructorMiddleware
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
        if (Auth::user()->role == 'instructor' && Auth::user()->is_approved == 1) {
            return $next($request);
        } else {
            $msg = 'You are not approved for instructor. Please wait or contact with Admin.';
            return redirect('/')->with('auth-message', $msg);
        }
    }
}
