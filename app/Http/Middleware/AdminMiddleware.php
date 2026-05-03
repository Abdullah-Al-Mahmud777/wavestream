<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access admin area.');
        }

        // Check if the user is an admin
        if (Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // If not an admin, redirect with error message
        return redirect('/')->with('error', 'Unauthorized access. Admin privileges required.');
    }
}
