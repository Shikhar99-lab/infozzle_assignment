<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MultiStepMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if step 1 is completed
        if (!$request->session()->has('username') || !$request->session()->has('email') || !$request->session()->has('password')) {
            // Redirect to step 1 if not completed
            return redirect('/register/step1')->with('error', 'Please complete step 1 first.');
        }
        return $next($request);
    }
}
