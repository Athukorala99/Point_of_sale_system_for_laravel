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
        Schema::create('addstoredetails', function (Blueprint $table) {
            $table->id();
            $table->integer('addstore_id');
            $table->integer('batch_no');
            $table->integer('product_id');
            $table->float('quantity');
            $table->float('stock_quantity');
            $table->float('unitprice');
            $table->float('amount');
            $table->integer('userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addstoredetails');
    }
};
