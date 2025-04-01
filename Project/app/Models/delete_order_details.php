<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delete_order_details extends Model
{
    use HasFactory;
    protected $table = 'delete_order_details';
    protected $fillable = [
        'del_order_id',
        'product_id',
        'quantity',
        'price'
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
   
    public function deleteorder(){
        return $this->belongsTo(delete_order::class, 'del_order_id');
    }
}
