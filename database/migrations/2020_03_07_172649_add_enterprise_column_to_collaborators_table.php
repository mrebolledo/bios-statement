<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnterpriseColumnToCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collaborators', function (Blueprint $table) {
            $table->bigInteger('enterprise_id')->unsigned()->nullable()->after('type_id');
            $table->string('first_name')->nullable()->after('identifier');
            $table->string('last_name')->nullable()->after('identifier');
            $table->string('email')->unique()->nullable()->after('identifier');
            $table->string('phone')->nullable()->after('identifier');
            $table->boolean('is_auth')->default(1);
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collaborators', function (Blueprint $table) {
            $table->dropForeign('collaborators_enterprise_id_foreign');
            $table->dropColumn('enterprise_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('is_auth');
        });
    }
}
