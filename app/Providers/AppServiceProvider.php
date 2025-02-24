<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\WorkRecord;
use App\Policies\WorkRecordPolicy;

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
    public function boot(): void
    {
        //
    }
}
