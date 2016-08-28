<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->longText('elements');
            $table->timestamps();
        });
    }

    /**
     * Reverse thek migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tiles');
    }
}
