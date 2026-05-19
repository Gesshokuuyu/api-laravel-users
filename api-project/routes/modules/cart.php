<?php

use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::prefix('/cart')
    ->middleware(['throttle:api', 'auth:sanctum'])
    ->group(function (){

        Route::get('/', [ShoppingCartController::class, 'index'])->name('cart.index');

        Route::post("/addToCart", [ShoppingCartController::class, "addToCart"])->name('cart.addItem');

        Route::delete('/remove', [ShoppingCartController::class, "remove"])->name("cart.removeItem");
    });
