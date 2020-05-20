<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationCodeToCollaboratorStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collaborator_statements', function (Blueprint $table) {
            $table->string('verification_code')->unique()->nullable()->after('collaborator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collaborator_statements', function (Blueprint $table) {
            $table->dropColumn('verification_code');
        });
    }
}
