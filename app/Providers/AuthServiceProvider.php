<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Idea;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Role
        Gate::define('admin', function(User $user) : bool{
            return $user->is_admin;
        });
        // Permission
        Gate::define('idea.delete', function(User $user, Idea $idea) : bool{
            return $user->is_admin || $user->id === $idea->user_id;
        });
        Gate::define('idea.edit', function(User $user, Idea $idea) : bool{
            return $user->is_admin || $user->id === $idea->user_id;
        });
    }
}
