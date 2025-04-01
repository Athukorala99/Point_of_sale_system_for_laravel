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
        Schema::create('addstores', function (Blueprint $table) {
            $table->id();
            $table-> string('addstore_id');
            $table-> integer('Supplier');
            $table-> float('amount');
            $table->float('bill_number');
            $table->string('bill_date');
            $table-> float('discount')->nullable();
            $table-> integer('user_id');
            $table-> string('addstore_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addstores');
    }
};
