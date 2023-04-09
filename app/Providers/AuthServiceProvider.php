<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\AuthGroup;
use App\Models\AuthGroupUser;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('asAdmin', function (User $user) {
            return AuthGroupUser::where('user_id', $user->id)
                ->whereHas('group', function ($query) {
                    $query->where('name', 'Admin');
                })->exists();
        });

        Gate::define('asUser', function (User $user) {
            return AuthGroupUser::where('user_id', $user->id)
                ->whereHas('group', function ($query) {
                    $query->where('name', 'User');
                })->exists();
        });

        Gate::define('hasUserProfile', function (User $user) {
            return UserProfile::where('user_id', $user->id)->exists();
        });
    }
}
