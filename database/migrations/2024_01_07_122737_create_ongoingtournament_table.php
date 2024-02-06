<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngoingTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ongoingtournament', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->string('image');
            $table->string('win_screenshots')->nullable();
            $table->string('title');
            $table->string('map');
            $table->string('game_type');
            $table->string('mode');
            $table->decimal('entry_fees', 10, 2);
            $table->decimal('prize_pool', 10, 2);
            $table->decimal('per_kill', 10, 2);
            $table->decimal('from_bonus', 10, 2);
            $table->dateTime('schedule');
            $table->integer('total_players');
            $table->integer('joined_players');
            $table->text('details')->nullable();
            $table->string('room_id');
            $table->string('message');
            $table->string('youtube_video')->nullable();
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
        Schema::dropIfExists('ongoingtournament');
    }
}
