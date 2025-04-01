<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Laravel Pos');
            $table->string('company_address')->default('174/A Kegalle');
            $table->string('company_phone')->default('0769783829');
            $table->string('company_email')->default('super@gmail.com');
            $table->string('company_logo')->default('logo.png')->nullable();
            $table->timestamps();
        });
        DB::table('companies')->insert([
            'company_name' => 'Abc Company',
            'company_address' => 'addresss',
            'company_phone' => '07123456789',
            'company_email' => 'example@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};