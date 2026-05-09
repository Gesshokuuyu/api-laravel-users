<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ordersAsBuyer(): HasMany
    {
        return $this->hasMany(Orders::class, 'buyer_id');
    }

    public function ordersAsSeller(): HasMany
    {
        return $this->hasMany(Orders::class, 'seller_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Addresses::class);
    }

    public function shoppingCart(): HasOne
    {
        return $this->hasOne(ShoppingCart::class, 'user_id');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'user_id');
    }
}
