<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Horizon\Horizon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
        Horizon::auth(function ($request) {
            if ('local' === env('APP_ENV', 'local')) {
                return true;
            }
            $get_ip = $request->getClientIp();
            $can_ip = env('HORIZON_IP', '127.0.0.1');

            return $get_ip === $can_ip;
        });
    }
}
