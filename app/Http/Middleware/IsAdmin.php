<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Redirect to login if not logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        // Check if the user has 'admin' role
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access – Admins only.');
        }

        return $next($request);
    }
}
