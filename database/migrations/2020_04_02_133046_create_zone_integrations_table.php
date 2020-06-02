<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_integrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('zone_id')->unsigned();
            $table->bigInteger('destination_zone_id')->unsigned();
            $table->bigInteger('modifier_id')->unsigned()->nullable();
            $table->integer('empty_nights');
            $table->timestamps();

            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('destination_zone_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('zone_integrations');
    }
}
