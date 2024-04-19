<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Import Auth



class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // Check if user is authenticated
            if (!Auth::check()) {
        // If user is not authenticated, redirect to login page
            return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu!');
    }

        // Check if user role is allowed
            if (in_array(Auth::user()->role, $role)) {
        // If user role is allowed, proceed to the next middleware or route
            return $next($request);
    }

        // If user role is not allowed, redirect back with error message
        return redirect()->back()->with('accessError', 'Anda tidak memiliki akses!');
    }
}
