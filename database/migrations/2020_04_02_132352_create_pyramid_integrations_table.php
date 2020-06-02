<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePyramidIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyramid_integrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pyramid_id')->unsigned();
            $table->bigInteger('destination_pyramid_id')->unsigned();
            $table->bigInteger('modifier_id')->unsigned()->nullable();
            $table->integer('empty_nights');
            $table->timestamps();

            $table->foreign('pyramid_id')->references('id')->on('pyramids')->onDelete('cascade');
            $table->foreign('destination_pyramid_id')->references('id')->on('pyramids')->onDelete('cascade');
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
        Schema::dropIfExists('pyramid_integrations');
    }
}
