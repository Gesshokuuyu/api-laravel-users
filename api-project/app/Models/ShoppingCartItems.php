<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCartItems extends Model
{
    public function shoppingCart(): BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
