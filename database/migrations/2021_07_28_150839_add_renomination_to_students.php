<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRenominationToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->uuid('renomination_id')->nullable();
            $table->bigInteger('prem_number')->nullable();
            $table->foreign('renomination_id')->references('id')->on('religion_renominations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('renomination_id');

            $table->dropColumn('renomination_id');
            $table->dropColumn('prem_number');
        });
    }
}
