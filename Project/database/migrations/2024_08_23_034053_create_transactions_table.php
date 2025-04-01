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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table-> string('order_id');
            $table-> string('paid_amount');
            $table-> string('balance');
            $table-> string('user_id');
            $table-> date('transac_date');
            $table-> string('transac_amount');
            $table->string('cash')->nullable();
            $table->string('bank')->nullable();
            $table->string('credit_card')->nullable();
            $table->string('consumer_credit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
