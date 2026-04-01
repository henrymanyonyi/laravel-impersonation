<?php

namespace Henrymanyonyi\Impersonation\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AllowImpersonation
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            abort(403, 'Not authenticated');
        }

        if (!method_exists(Auth::user(), 'canImpersonate')) {
            abort(403, 'Impersonation trait missing');
        }

        if (!Auth::user()->canImpersonate()) {
            abort(403, 'You are not allowed to impersonate users');
        }

        return $next($request);
    }
}
