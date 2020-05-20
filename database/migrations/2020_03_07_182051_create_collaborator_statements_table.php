<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborator_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('collaborator_id')->unsigned();
            $table->dateTime('statement_date');

            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaborator_statements');
    }
}
