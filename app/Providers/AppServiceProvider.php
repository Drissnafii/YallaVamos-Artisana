<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Blade;
use App\View\Components\SvgIcon;
use Illuminate\Support\ServiceProvider;

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
        // Personnalisation du lien de réinitialisation de mot de passe
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url("/reset-password/{$token}?email={$user->email}");
        });

        Blade::component('svg-icon', SvgIcon::class);
    }
}
