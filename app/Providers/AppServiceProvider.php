<?php

namespace App\Providers;

use App\Interface\AppointmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\AppointmentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
              AppointmentRepositoryInterface::class,
        AppointmentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
