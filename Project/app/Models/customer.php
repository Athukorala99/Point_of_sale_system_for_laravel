<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address',
        'amount',
        'alert_amount'
    ];
}