<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deleteitem extends Model
{
    use HasFactory;
    protected $table = 'deleteitems';
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'price',
    ];
    public function userdata()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
