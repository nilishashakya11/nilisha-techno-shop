<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    // If the user is not logged in, or their role is not in the allowed list
    if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
        // Stop them and show an "Unauthorized" error
        abort(403, 'You do not have permission to access this page.');
    }

    return $next($request);
}
}
