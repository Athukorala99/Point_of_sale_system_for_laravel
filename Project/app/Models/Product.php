<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'price',
        'category',
        'alert_stock',
        'quantity', 
        'barcode',
        'editprice',
        'print_name',
        'supplier',
        'retail_price',
        'wholesale_price',
        'special_price',
    ];
    public function orderdetail(){
        return $this->hasMany('App\Models\Order_detail');
    }
    public function deleteorderdetail(){
        return $this->hasMany(delete_order_details::class, 'product_id');
    }
    public function cart(){
        return $this->hasMany('App\Models\Cart');
    }
    public function cate(){
        return $this->belongsTo(category::class, 'category');
    }
    public function addstorecart(){
        return $this->hasMany('App\Models\addstorecart');
    }
    public function addstoredetail(){
        return $this->hasMany('App\Models\addstoredetails');
    }

    public function profitdetails()
    {
        return $this->hasMany(profitdetails::class, 'product_id');
    }

    public function deleteitem(){
        return $this->hasMany('App\Models\Deleteitem');
    }
}
