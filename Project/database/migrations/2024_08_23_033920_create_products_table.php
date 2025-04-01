<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('product_name');
            $table->string('category')->nullable();
            $table->float('price');
            $table->float('retail_price');
            $table->float('wholesale_price');
            $table->float('special_price');
            $table->boolean('editprice')->default(0);
            $table->float('quantity')->nullable();
            $table->string('print_name');
            $table->string('supplier');
            $table->integer('alert_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
