<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborator_movements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('collaborator_id')->unsigned()->nullable();
            $table->bigInteger('sector_id')->unsigned();
            $table->date('check_in_date');
            $table->time('check_in_time');
            $table->date('departure_date')->nullable();
            $table->date('departure_time')->nullable();
            $table->boolean('entered');
            $table->string('reason')->nullable();

            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('set null');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaborator_movements');
    }
}
