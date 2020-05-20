<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CollaboratorMakeNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `collaborators` MODIFY `last_access` DATETIME NULL;');
        DB::statement('ALTER TABLE `collaborators` MODIFY `access_start` DATE NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `collaborators` MODIFY `last_access` DATETIME NOT NULL;');
        DB::statement('ALTER TABLE `collaborators` MODIFY `access_start` DATE NOT NULL;');
    }
}
