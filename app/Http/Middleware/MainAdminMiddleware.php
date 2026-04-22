<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MainAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();
        if (! ($user->is_main_admin ?? false)) {
            if ($request->expectsJson()) {
                abort(403, 'Unauthorized. Main admin access required.');
            }

            return redirect()->route('dashboard')->with('error', 'Only the main admin can approve or reject registration requests.');
        }

        return $next($request);
    }
}
