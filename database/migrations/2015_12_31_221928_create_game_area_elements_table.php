<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameAreaElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_area_elements', function (Blueprint $table) {
            $table->increments('id');

            // An element is part of an area
            $table->integer('game_area_id')->unsigned()->nullable()->index();
            $table->foreign('game_area_id')->references('id')->on('game_areas')->onDelete('cascade');

            // And an element is a child of a
            $table->integer('game_tile_id')->unsigned()->index();
            $table->foreign('game_tile_id')->references('id')->on('game_tiles')->onDelete('cascade');


            // Subelement offset of minion position.
            $table->integer('x');
            $table->integer('y');

            $table->string('type');

            $table->integer('subtype')->nullable(); // e.g. inn / cathedral

            $table->integer('connections'); // bitmask of connections POST ROTATE

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
        Schema::drop('game_area_elements');
    }
}
