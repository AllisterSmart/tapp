<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->integer('map')->default(0);
            $table->string('category')->nullable();
            $table->timestamp('game_mode')->useCurrent();
            $table->timestamp('entry_fees')->nullable();
            $table->string('prize_pool')->nullable();
            $table->string('per_kill')->nullable();
            $table->decimal('from_bonus', 10, 2)->default(0);
            $table->decimal('total_players', 10, 2)->default(0);
            $table->decimal('start_rank_1', 10, 2)->default(0);
            $table->decimal('start_rank_2', 10, 2)->default(0);
            $table->integer('amount')->default(0);
            $table->integer('from_schedule')->default(0);
            $table->integer('to_schedule')->default(0);
            $table->integer('t_details')->default(0);
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
        Schema::dropIfExists('tournaments');
    }
}
