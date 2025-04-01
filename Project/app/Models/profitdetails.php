<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profitdetails extends Model
{
    use HasFactory;
    protected $table = 'profitdetails';
    protected $fillable = [
        'order_id',
        'product_id',
        'addstoredetail_id',
        'quantity',
        'profit',
        'date',
        'user_id'
    ];
    public function product(){
        return $this->belongsTo(addstoredetails::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function deleteorderdetail(){
        return $this->belongsTo(addstoredetails::class, 'addstoredetail_id');
    }
}
