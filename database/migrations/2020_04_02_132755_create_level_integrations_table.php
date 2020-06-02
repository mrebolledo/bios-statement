<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_integrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('level_id')->unsigned();
            $table->bigInteger('destination_level_id')->unsigned();
            $table->bigInteger('modifier_id')->unsigned()->nullable();
            $table->integer('empty_nights');
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('pyramid_levels')->onDelete('cascade');
            $table->foreign('destination_level_id')->references('id')->on('pyramid_levels')->onDelete('cascade');
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
        Schema::dropIfExists('level_integrations');
    }
}
