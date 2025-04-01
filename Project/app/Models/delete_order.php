<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delete_order extends Model
{
    use HasFactory;
    protected $table = 'delete_orders';
    protected $fillable = [
        'userid',
        'total',
        'cash',
        'bank',
        'card',
        'balance',
    ];
    public function deleteorderdetail(){
        return $this->hasMany(delete_order_details::class, 'del_order_id');
    }
    public function userdata(){
        return $this->belongsTo(User::class, 'userid');
    }
}
