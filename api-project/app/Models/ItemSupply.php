<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemSupply extends Model
{

    protected $fillable = [
        "item_id",
        "used",
        "quantity_available"
    ];

    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
