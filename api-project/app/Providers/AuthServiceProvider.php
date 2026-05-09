<?php

namespace App\Providers;
use App\Models\Item;
use App\Models\ShoppingCartItems;
use App\Policies\CartPolicy;
use App\Policies\ItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected  $policies = [
        Item::class => ItemPolicy::class,
        ShoppingCartItems::class => CartPolicy::class
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
