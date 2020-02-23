<?php

namespace ScaryLayer\Hush\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!auth()->check() || !auth()->user()->permitted($permission)) {
            abort(403, 'You have no permission for doing this');
        }

        return $next($request);
    }
}
