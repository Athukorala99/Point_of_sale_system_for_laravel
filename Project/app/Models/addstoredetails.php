<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addstoredetails extends Model
{
    use HasFactory;
    protected $table = 'addstoredetails';
    protected $fillable = [
        'addstore_id',
        'batch_no',
        'product_id',
        'quantity',
        'stock_quantity',
        'unitprice',
        'amount',
        'userid'
        ];
        public function product(){
            return $this->belongsTo('App\Models\Product');
        }
       
        public function addstore(){
            return $this->belongsTo('App\Models\addstore');
        }
        public function profitdetails()
    {
        return $this->hasMany(profitdetails::class, 'addstoredetail_id');
    }
}
