<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'user_id',
        'home_view',
        'order_view',
        'product_view',
        'product_add',
        'product_edit',
        'product_delete',
        'user_view',
        'user_add',
        'user_edit',
        'user_delete',
        'caregory_view',
        'caregory_add',
        'caregory_edit',
        'caregory_delete',
    ];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    
}
