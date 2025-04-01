<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerhistory extends Model
{
    use HasFactory;
    protected $table = 'customerhistories';
    protected $fillable = [
        'customer_id',
        'date',
        'billno',
        'amount',
        'balance'
    ];
}
