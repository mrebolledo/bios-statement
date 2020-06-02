<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPyramidToZoneIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zone_integrations', function (Blueprint $table) {
            $table->bigInteger('pyramid_id')->unsigned()->nullable()->after('id');
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
        Schema::table('zone_integrations', function (Blueprint $table) {
            $table->dropForeign('pyramid_id');
            $table->dropColumn('pyramid_id');
        });
    }
}
