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
        Schema::create('delete_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->float('total')->nullable();
            $table->float('cash')->nullable();
            $table->float('bank')->nullable();
            $table->float('card')->nullable();
            $table->float('balance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delete_orders');
    }
};
