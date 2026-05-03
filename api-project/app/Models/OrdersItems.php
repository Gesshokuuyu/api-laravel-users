<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdersItems extends Model
{
    public function order() :BelongsTo
    {
        return $this->belongsTo(Orders::class, "order_id");
    }

    public function item() :BelongsTo
    {
        return $this->belongsTo(Item::class, "item_id");
    }
}
