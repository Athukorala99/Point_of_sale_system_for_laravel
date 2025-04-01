<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payoutcash extends Model
{
    use HasFactory;
    protected $table = 'payoutcashes';
    protected $fillable = [
        'user_id',
        'payoutcash',
        'discription',
       
    ];
}
