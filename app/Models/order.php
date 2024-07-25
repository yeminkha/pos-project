<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_name',
        'image',
        'status',
        'phone',
        'address',
        'user_name',
        'smile_gift',
        'theme',
        'wish',
        'message',
        'quantity',
        'price',
        'total',
        'orderCode',
    ];
}
