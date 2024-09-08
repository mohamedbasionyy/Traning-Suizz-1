<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{


    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => PostPolicy::class,
    ];

    /**
     * Register any authentication authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-product', function (User $user,Product $product) {
            return $user->id === $product->user_id;
        });

        //
    }



}
