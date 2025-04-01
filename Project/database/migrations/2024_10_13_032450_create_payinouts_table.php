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
        Schema::create('payinouts', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->float('payincash');
            $table->float('payoutcash')->nullable();
            $table->float('cash')->nullable();
            $table->float('card')->nullable();
            $table->float('bank')->nullable();
            $table->float('consumer_credit')->nullable();
            $table->float('hand_money')->nullable();
            $table->integer('bill_count')->nullable();
            $table->float('different')->nullable();
            $table->date('payoutdate');
            $table->integer('updateby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payinouts');
    }
};
