<?php

namespace App\Providers;

use App\Http\Responses\CustomLoginResponse;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,
            CustomLoginResponse::class,
        );

        $this->app->singleton(
            \Livewire\Mechanisms\HandleRequests\HandleRequests::class,
            \App\Livewire\HandleRequests::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || str_starts_with((string) config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        //Registrar observers
        // \App\Models\Associate::observe(\App\Observers\AssociateObserver::class);

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                \Illuminate\Support\Facades\View::share('siteSettings', \App\Models\SiteSetting::getSettings());
            }
        } catch (\Throwable $e) {
            // Silently fallback if db connection fails during build/console
        }
    }
}
