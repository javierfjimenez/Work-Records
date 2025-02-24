<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\WorkRecord;
use App\Policies\WorkRecordPolicy;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
 

protected $policies = [
    WorkRecord::class => WorkRecordPolicy::class,
];
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
    public function boot()
{
    if (config('app.env') === 'production') {
        URL::forceScheme('https'); // Forzar que todas las URLs usen HTTPS
    }
}
}
