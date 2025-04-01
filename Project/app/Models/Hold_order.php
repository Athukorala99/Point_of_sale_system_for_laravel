<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hold_order extends Model
{
    use HasFactory;
    protected $table = 'hold_orders';
    protected $fillable = [
        'user_id',
        'date'
    ];
}
