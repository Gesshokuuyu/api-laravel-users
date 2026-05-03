<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Orders extends Model
{
    public function seller() :BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer() :BelongsTo
    {
        return $this->belongsTo(User::class, "buyer_id");
    }

    public function address() :BelongsTo
    {
        return $this->belongsTo(Addresses::class, "shipping_addresses_id");
    }

    public function shippingCompany() :BelongsTo
    {
        return $this->belongsTo(ShippingCompanies::class, "shipping_company_id");
    }

    public function coupon() :BelongsTo
    {
        return $this->belongsTo(Coupons::class, 'coupon_id');
    }

    public function items() :HasMany
    {
        return $this->hasMany(OrdersItems::class, "order_id");
    }

}
