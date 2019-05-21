<?php

namespace App\Providers;

use App\Models\Admins;
use App\Models\Apartments;
use App\Models\Rooms;
use App\Policies\RoomsPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
          Rooms::class => RoomsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('view-rooms', function (Admins $user, Apartments $apartment) {
        return $user->id == $apartment->admins_id;
    });
    }
}
