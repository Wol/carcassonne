<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('type');

            $table->integer('player_id')->unsigned()->index();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');

            // A minion belongs to a game area element
            $table->integer('game_area_element_id')->unsigned()->nullable()->index();
            $table->foreign('game_area_element_id')->references('id')->on('game_area_elements')->onDelete('cascade');


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
        Schema::drop('minions');
    }
}
