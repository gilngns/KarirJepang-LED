<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::attempting(function ($credentials, $remember) {
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            if (!$user || !$user->is_active || !in_array($user->role, ['admin', 'staff'])) {
                return false;
            }
        });
    }
}
