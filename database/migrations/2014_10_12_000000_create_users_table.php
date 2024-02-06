<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('referal_code')->nullable();
            $table->string('user_referal_code')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('address')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->decimal('add_balance', 10, 2)->default(0);
            $table->decimal('total_balance', 10, 2)->default(0);
            $table->string('transition_id')->nullable();
            $table->decimal('withdraw_amount', 10, 2)->default(0);
            $table->timestamp('withdraw_time')->nullable();
            $table->string('role')->default('user');
            $table->string('favoriteColor')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
