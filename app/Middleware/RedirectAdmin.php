<?php

namespace ScaryLayer\Hush\Middleware;

use Closure;

class RedirectAdmin
{
    /**
     * Handle an incoming request and check if user is permitted
     * to enter the dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return auth()->check()
            ? redirect(auth()->user()->permitted('admin') ? route('admin.index') : '/')
            : $next($request);
    }
}
