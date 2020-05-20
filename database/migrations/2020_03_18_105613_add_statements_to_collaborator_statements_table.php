<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatementsToCollaboratorStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collaborator_statements', function (Blueprint $table) {
            $table->integer('statement_1')->nullable();
            $table->integer('statement_2')->nullable();
            $table->integer('statement_3')->nullable();
            $table->integer('can_enter')->nullable();
            $table->text('reason')->nullable();
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
            $table->dropColumn('statement_1');
            $table->dropColumn('statement_2');
            $table->dropColumn('statement_3');
            $table->dropColumn('can_enter');
            $table->dropColumn('reason');
        });
    }
}
