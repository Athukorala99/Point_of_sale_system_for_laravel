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
        Schema::create('profitdetails', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('product_id');
            $table->integer('addstoredetail_id');
            $table->integer('quantity');
            $table->float('profit');
            $table->string('date');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profitdetails');
    }
};
