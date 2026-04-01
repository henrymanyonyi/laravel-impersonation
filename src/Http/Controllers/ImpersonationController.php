<?php

namespace Henrymanyonyi\Impersonation\Http\Controllers;

use Illuminate\Routing\Controller;
use Henrymanyonyi\Impersonation\Services\ImpersonationManager;
use App\Models\User;

class ImpersonationController extends Controller
{
    protected $manager;

    public function __construct(ImpersonationManager $manager)
    {
        $this->manager = $manager;
    }

    public function start(User $user)
    {
        $this->manager->start($user);

        return redirect()->route('dashboard');
    }

    public function stop()
    {
        $this->manager->stop();

        return redirect()->route('dashboard');
    }
}
