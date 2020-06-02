<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePyramidConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyramid_configurations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pyramid_id')->unsigned();
            $table->bigInteger('modifier_id')->unsigned()->nullable();
            $table->integer('another_pyramid');
            $table->integer('level_up');
            $table->integer('level_down');
            $table->integer('another_zone');
            $table->timestamps();

            $table->foreign('pyramid_id')->references('id')->on('pyramids')->onDelete('cascade');
            $table->foreign('modifier_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pyramid_configurations');
    }
}
