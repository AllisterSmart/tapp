<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserregisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('userregister', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('user_id');
    $table->string('state');
    $table->string('mobile_email');
    $table->string('dob');
    $table->string('referalcode')->nullable();
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
        Schema::dropIfExists('userregister');
    }
}
