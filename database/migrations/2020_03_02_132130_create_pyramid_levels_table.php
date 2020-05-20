<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePyramidLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyramid_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pyramid_id')->unsigned();
            $table->string('name');
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pyramid_id')->references('id')->on('pyramids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pyramid_levels');
    }
}
