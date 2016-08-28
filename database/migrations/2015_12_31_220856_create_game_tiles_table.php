<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_tiles', function (Blueprint $table) {
            $table->increments('id');

            // The tile is part of a game!
            $table->integer('game_id')->unsigned()->index();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');


            // A game tile entity references a base tile. You can have two gametiles referencing one base tile
            $table->integer('tile_id')->unsigned()->index();
            $table->foreign('tile_id')->references('id')->on('tiles')->onDelete('cascade');

            // Position on the board this tile is in
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();

            // And its rotation
            $table->integer('rotation')->nullable();

            // Which turnID the tile should be placed in / was placed on.
            $table->integer('turnid');

            // Who placed the tile.
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


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
        Schema::drop('game_tiles');
    }
}
