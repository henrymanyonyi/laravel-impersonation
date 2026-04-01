<?php

namespace Henrymanyonyi\Impersonation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Henrymanyonyi\Impersonation\Http\Middleware\DetectImpersonation;

class ImpersonationServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // 1. Load routes automatically
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // 2. Publish config file
        $this->publishes([
            __DIR__ . '/../config/impersonation.php' => config_path('impersonation.php'),
        ], 'impersonation-config');

        // 3. Publish migration
        $this->publishes([
            __DIR__ . '/database/migrations/create_impersonation_logs_table.php'
            => database_path('migrations/' . date('Y_m_d_His') . '_create_impersonation_logs_table.php'),
        ], 'impersonation-migrations');

        // 4. IMPORTANT → this is what makes it work with Jetstream + Livewire
        $router->pushMiddlewareToGroup('web', DetectImpersonation::class);
    }

    public function register()
    {
        //
    }
}
