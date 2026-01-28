<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Default Laravel policies (you can keep or remove these if unused)
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        // Register our Task Policy
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
        |--------------------------------------------------------------------------
        | Define Gates (optional – you can add custom gates here if needed)
        |--------------------------------------------------------------------------
        |
        | Example:
        | Gate::define('edit-any-task', function ($user) {
        |     return $user->is_admin; // if you ever add admin role
        | });
        |
        */
    }
}