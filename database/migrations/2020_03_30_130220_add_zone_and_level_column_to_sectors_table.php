<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoneAndLevelColumnToSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->bigInteger('level_id')->unsigned();
            $table->bigInteger('zone_id')->unsigned();

            $table->foreign('level_id')->references('id')->on('pyramid_levels');
            $table->foreign('zone_id')->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->dropForeign(['zone_id','level_id']);
            $table->dropColumn(['zone_id','level_id']);
        });
    }
}
