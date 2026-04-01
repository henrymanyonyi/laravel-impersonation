<?php

namespace Cobuild\Impersonation;

use Illuminate\Support\ServiceProvider;

class ImpersonationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->publishes([
            __DIR__.'/../config/impersonation.php' => config_path('impersonation.php'),
        ], 'impersonation-config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_impersonation_logs_table.php'
                => database_path('migrations/'.date('Y_m_d_His').'_create_impersonation_logs_table.php'),
        ], 'impersonation-migrations');
    }
}