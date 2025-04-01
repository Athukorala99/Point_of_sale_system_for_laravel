<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addstorecart extends Model
{
    use HasFactory;
    protected $table = 'addstorecarts';

    protected $fillable = [
        'product_id',
        'product_qty',
        'product_price',
        'total_price',
        'user_id',
        'discount',
        'barcode'
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
