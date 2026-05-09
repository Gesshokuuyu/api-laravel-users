<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

class Item extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'code',
        'description',
        'price',
        'user_id',
        'available_stock'
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ordersItems(): HasMany
    {
        return $this->hasMany(OrdersItems::class, 'item_id');
    }

    public function shoppingCartItems(): HasMany
    {
        return $this->hasMany(ShoppingCartItems::class, 'item_id');
    }

    public function itemSupply(): HasOne
    {
        return $this->hasOne(ItemSupply::class, 'item_id');
    }
}
