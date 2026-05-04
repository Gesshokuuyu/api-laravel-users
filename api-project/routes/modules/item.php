<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('items')
    ->middleware(['throttle:api', 'auth:sanctum'])
    ->group(function (){

        Route::get('/',       [ItemController::class, 'index'])->name('item.index');
        Route::get("/search", [ItemController::class, 'search'])->name('item.search');
        Route::get("/{item}", [ItemController::class, 'show'])->name("item.show");

        Route::post('/create', [ItemController::class, 'create'])->name('item.create');

    });

