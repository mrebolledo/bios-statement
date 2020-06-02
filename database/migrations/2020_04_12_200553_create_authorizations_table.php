<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorizations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id')->unsigned()->nullable();
            $table->bigInteger('collaborator_sector_id')->unsigned();
            $table->bigInteger('authorizable_id');
            $table->string('authorizable_type');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_valid')->default(true);
            $table->boolean('gives_access')->default(true);
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('collaborator_sector_id')->references('id')->on('collaborator_sector')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorizations');
    }
}
