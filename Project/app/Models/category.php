<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
       'category_name'
   ];

   public function Product(){
    return $this->hasMany(category::class, 'category');
}
}
