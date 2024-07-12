<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('role')) {
            view()->share('role', $request->session()->get('role'));
        }
        return $next($request);
    }
}

