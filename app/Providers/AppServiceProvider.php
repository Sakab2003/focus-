<?php

namespace App\Providers;

use App\Models\Utilisateur;
use App\Observers\UtilisateurObserver;
use Illuminate\Support\ServiceProvider;
 use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

    // Enregistrer l'observer
    Utilisateur::observe(UtilisateurObserver::class);
    }
    public const HOME = '/dashboard';

}
