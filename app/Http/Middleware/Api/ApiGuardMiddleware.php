<?php

namespace App\Http\Middleware\Api;

use Closure;

class ApiGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        config(['auth.defaults.guard' => 'api']);

        return $next($request);
    }
}
