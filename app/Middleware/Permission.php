<?php

namespace ScaryLayer\Hush\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request and check if user is permitted
     * to enter the dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $redirectTo = null)
    {
        if (!auth()->check() || !auth()->user()->permitted($permission)) {
            if (!auth()->check()) {
                session()->put('redirect-to', $request->url());
            }

            if ($redirectTo) {
                return redirect()->route($redirectTo);
            }

            abort(403, 'You have no permission for doing this');
        }

        return $next($request);
    }
}
