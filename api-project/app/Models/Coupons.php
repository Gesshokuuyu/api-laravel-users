<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupons extends Model
{
    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'coupon_id');
    }
}
