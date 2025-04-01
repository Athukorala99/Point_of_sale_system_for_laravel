<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hold_orderDetail extends Model
{
    use HasFactory;
    protected $table = 'hold_order_details';
    protected $fillable = [
        'hold_id',
        'product_id',
        'barcode',
        'product_qty',
        'product_price',
        'discount',
        'user_id'
    ];
}
