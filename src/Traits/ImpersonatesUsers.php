<?php

namespace Henrymanyonyi\Impersonation\Traits;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

trait ImpersonatesUsers
{
    public function isImpersonating(): bool
    {
        return Session::has('impersonator_id');
    }

    public function impersonator()
    {
        return Session::has('impersonator_id')
            ? static::find(Session::get('impersonator_id'))
            : null;
    }

    public function canImpersonate(): bool
    {
        return $this->is_admin ?? false;
    }

    public function canBeImpersonated(): bool
    {
        return !$this->is_admin;
    }

    public function leaveImpersonation()
    {
        if (!Session::has('impersonator_id')) return;

        $adminId = Session::get('impersonator_id');

        Session::forget('impersonator_id');

        Auth::loginUsingId($adminId);
    }
}
