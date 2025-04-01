<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payinout extends Model
{
    use HasFactory;
    protected $table = 'payinouts';
    protected $fillable = [
        'userid',
        'payincash',
        'payoutcash',
        'cash',
        'card',
        'bank',
        'consumer_credit',
        'payoutdate',
        'updateby',
        'hand_money',
        'bill_count',
        'different',
    ];
    public function userdata()
    {
        return $this->belongsTo(User::class, 'userid');
    }
    public function userdataa()
    {
        return $this->belongsTo(User::class, 'updateby');
    }
}
