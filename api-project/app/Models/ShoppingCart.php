<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingCart extends Model
{

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'shopping_cart_items', 'cart_id', 'item_id')
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }

    public function shoppingCartItems(): HasMany
    {
        return $this->hasMany(ShoppingCartItems::class, 'cart_id');
    }
}
