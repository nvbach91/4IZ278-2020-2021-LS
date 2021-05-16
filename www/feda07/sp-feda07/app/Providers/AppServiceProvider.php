<?php

namespace App\Providers;

use App\Services\Impl\IReservationServiceImpl;
use App\Services\Impl\ServiceServiceImpl;
use App\Services\IReservationService;
use App\Services\IServiceService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IServiceService::class, ServiceServiceImpl::class);
        $this->app->bind(IReservationService::class, IReservationServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
