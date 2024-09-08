<?php

namespace App\Providers;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Services\CustomService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
//        $this->app->bind(CustomService::class,function($app){
//            return new CustomService();
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Gate::policy(Order::class, OrderPolicy::class);
    }
}

