<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Membuat gerbang akses bernama 'is-admin'
        Gate::define('is-admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}