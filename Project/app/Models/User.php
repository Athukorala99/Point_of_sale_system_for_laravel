<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email', 
        'contact',
        'password', 
        'is_admin',
        'is_active',

        'payincash',
        'payoutcash',
        'cash',
        'card',
        'bank',
        'consumer_credit',
        'hand_money',
        'bill_count',


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
        'user_status',

        'caregory_view',
        'caregory_add',
        'caregory_edit',
        'caregory_delete',

        'supplier_view',
        'supplier_add',
        'supplier_edit',
        'supplier_delete',

        'customer_view',
        'customer_add',
        'customer_edit',
        'customer_delete',
        'customer_pay',

        'payin_out',
        'payin',
        'handmoney',

        'addstore_view',
        'addstore_list',
        'addstore_bill',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected function is_admin(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user", "admin"][$value],
        );
    }
    public function permission()
    {
        return $this->belongsTo('App\Models\permission');
    }
    public function deletorder(){
        return $this->hasMany(delete_order::class, 'userid');
    }

    public function payinout(){
        return $this->hasMany(payinout::class, 'userid');
    }
    public function payinouta(){
        return $this->hasMany(payinout::class, 'updateby');
    }
    public function profitdetails()
    {
        return $this->hasMany(profitdetails::class, 'user_id');
    }
    public function addstore()
    {
        return $this->hasMany(addstore::class, 'user_id');
    }
    public function transaction()
    {
        return $this->hasMany(transaction::class, 'user_id');
    }
    public function deleteitem()
    {
        return $this->hasMany(Deleteitem::class, 'user_id');
    }
}
