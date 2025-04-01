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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact')->nullable();
            $table->string('password');

            $table->float('payincash')->default(0)->nullable();
            $table->float('payoutcash')->default(0)->nullable();
            $table->float('cash')->default(0)->nullable();
            $table->float('card')->default(0)->nullable();
            $table->float('bank')->default(0)->nullable();
            $table->float('consumer_credit')->default(0)->nullable();
            $table->float('hand_money')->default(0)->nullable();
            $table->integer('bill_count')->default(0)->nullable();

            $table->boolean('is_admin')->default(0);
            $table->boolean('is_active')->default(1);// 0 = not active, 1 = active

            $table->boolean('home_view')->default(0);

            $table->boolean('order_view')->default(0);

            $table->boolean('product_view')->default(0);
            $table->boolean('product_add')->default(0);
            $table->boolean('product_edit')->default(0);
            $table->boolean('product_delete')->default(0);

            $table->boolean('user_view')->default(0);
            $table->boolean('user_add')->default(0);
            $table->boolean('user_edit')->default(0);
            $table->boolean('user_delete')->default(0);
            $table->boolean('user_status')->default(0);

            $table->boolean('caregory_view')->default(0);
            $table->boolean('caregory_add')->default(0);
            $table->boolean('caregory_edit')->default(0);
            $table->boolean('caregory_delete')->default(0);

            $table->boolean('supplier_view')->default(0);
            $table->boolean('supplier_add')->default(0);
            $table->boolean('supplier_edit')->default(0);
            $table->boolean('supplier_delete')->default(0);

            $table->boolean('customer_view')->default(0);
            $table->boolean('customer_add')->default(0);
            $table->boolean('customer_edit')->default(0);
            $table->boolean('customer_delete')->default(0);
            $table->boolean('customer_pay')->default(0);

            $table->boolean('payin_out')->default(0);
            $table->boolean('payin')->default(0);
            $table->boolean('handmoney')->default(0);

            $table->boolean('addstore_view')->default(0);
            $table->boolean('addstore_list')->default(0);
            $table->boolean('addstore_bill')->default(0);

            
            $table->rememberToken();
            $table->timestamps();
        }); 

        DB::table('users')->insert([
            'name' => 'Harith Athukorala',
            'email' => 'athukoralaharith@gmail.com', // Change to the desired email
            'contact' => '0769783829', // Change to the desired phone number
            'password' => bcrypt('12341234'), // Change to a secure password
            'is_admin' => 1,
            'is_active' => 1,

            'payincash' => 0,
            'payoutcash' => 0,
            'cash' => 0,
            'card' => 0,
            'bank' => 0,
            'consumer_credit' => 0,
            'hand_money' => 0,
            'bill_count' => 0,


            'home_view' => 1,
            'order_view' => 1,
            'product_view' => 1,
            'product_add' => 1,
            'product_edit' => 1,
            'product_delete' => 1,

            'user_view' => 1,
            'user_add' => 1,
            'user_edit' => 1,
            'user_delete' => 1,
            'user_status' => 1,

            'caregory_view' => 1,
            'caregory_add' => 1,
            'caregory_edit' => 1,
            'caregory_delete' => 1,

            'supplier_view' => 1,
            'supplier_add' => 1,
            'supplier_edit' => 1,
            'supplier_delete' => 1,

            'customer_view' => 1,
            'customer_add' => 1,
            'customer_edit' => 1,
            'customer_delete' => 1,
            'customer_pay' => 1,

            'payin_out' => 1,
            'payin' => 1,
            'handmoney' => 1,

            'addstore_view' => 1,
            'addstore_list' => 1,
            'addstore_bill' => 1,

            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
