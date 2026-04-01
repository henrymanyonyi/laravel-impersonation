<?php

namespace Henrymanyonyi\Impersonation\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DetectImpersonation
{
    public function handle($request, Closure $next)
    {
        View::share('isImpersonating', Session::has('impersonator_id'));
        View::share('impersonatorId', Session::get('impersonator_id'));

        return $next($request);
    }
}
