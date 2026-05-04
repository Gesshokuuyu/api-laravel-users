<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAudit extends Model
{
    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
