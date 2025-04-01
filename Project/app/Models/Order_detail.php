<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'userid'   ,
        'order_id',
        'product_id',
        'quantity',
        'unitprice',
        'amount',
        'price',
        ];
        public function product(){
            return $this->belongsTo('App\Models\Product');
        }
       
        public function order(){
            return $this->belongsTo('App\Models\Order');
        }
}
