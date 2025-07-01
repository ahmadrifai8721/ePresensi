<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null; // Return null for API requests expecting JSON responses
        } elseif ($request->is('api/*')) {
            return route('api.401'); // Redirect to a 401 route for API requests
        } else {
            return route('login');
        }
    }
}
