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
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access the admin dashboard.');
        }

        $user = Auth::user();
        if (!($user->is_admin ?? false)) {
            // For web requests, redirect to pending approval page
            if ($request->expectsJson()) {
                abort(403, 'Unauthorized. Admin access required.');
            }
            return redirect()->route('pending-approval')->with('error', 'Admin access required.');
        }

        return $next($request);
    }
}
