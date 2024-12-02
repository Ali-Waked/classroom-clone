<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        parent::register();
        // $this->app->singleton();
    }
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('add.pepoles.to.classroom', function (User $user, Classroom $classroom) {
            return $classroom->teachers()->where('id', Auth::id())->exists();
        });
        Gate::define('customise.apperance.classroom', function (User $user, Classroom $classroom) {
            return $classroom->user_id == $user->id;
        });
        Gate::define('teacher', function (User $user, Classroom $classroom) {
            return $classroom->teachers()->where('id', $user->id)->exists();
        });
    }
}
