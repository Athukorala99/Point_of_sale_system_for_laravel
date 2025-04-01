<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addstore extends Model
{
    use HasFactory;
    protected $table = 'addstores';
    protected $fillable = [
        'addstore_id',
        'Supplier',
        'amount',
        'discount',
        'user_id',
        'bill_date',
        'bill_number',
        'addstore_date'
    ];
    public function addstoredetails()
    {
        return $this->hasMany('App\Models\addstoredetails');
    }
    public function userdata()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function suppliers()
    {
        return $this->belongsTo('App\Models\Supplier', 'Supplier');
    }
}
