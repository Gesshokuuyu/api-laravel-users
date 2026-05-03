<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
