<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'order_id',
        'paid_amount',
        'balance',
        'user_id',
        'transac_date',
        'transac_amount',
        'cash',
        'bank',
        'credit_card'
    ];
    public function userdata()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
