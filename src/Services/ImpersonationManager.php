<?php

namespace Henrymanyonyi\Impersonation\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ImpersonationManager
{
    public function start($user)
    {
        $admin = Auth::user();

        if (!$admin->canImpersonate()) {
            abort(403);
        }

        if (!$user->canBeImpersonated()) {
            abort(403);
        }

        Session::put('impersonator_id', $admin->id);

        Auth::login($user);
    }

    public function stop()
    {
        if (!Session::has('impersonator_id')) return;

        $adminId = Session::get('impersonator_id');

        Session::forget('impersonator_id');

        Auth::loginUsingId($adminId);
    }
}
