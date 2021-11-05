<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // define hak akses untuk edit/delete/tambah

            Gate::define('superadmin', function (User $user) {
                return ($user->role === 3); // id of superadmin
            });

            Gate::define('admin', function (User $user) {
                return $user->role === 2;
            });

            Gate::define('user', function (User $user) {
                return $user->role === 1;
            });
    }
}
