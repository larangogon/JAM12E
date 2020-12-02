<?php

namespace App\Providers;

use App\Entities\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hasrole', function ($user) {
            if ($user->tieneRol()->count() > 0) {
                return true;
            }
            return false;
        });

        Gate::define('Administrator', function ($user) {
            return $user->hasRole('Administrator')
            ? Response::allow()
            : Response::deny('You must be a administrator.');
        });

        Gate::define('Guest', function ($user) {
            return $user->hasRole('Guest');
        });

        Gate::before(function ($user) {
            if ($user->hasRole('Administrator')) {
                return true;
            }
        });

        Passport::routes();
    }
}
