<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingCompanies extends Model
{
    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'shipping_company_id');
    }
}
