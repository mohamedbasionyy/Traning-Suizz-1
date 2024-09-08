<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{

    public function register(): void
    {
//        $this->app->bind(CustomServiceProvider::class,function ($app){
//            return new CustomServiceProvider($app);
//        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
