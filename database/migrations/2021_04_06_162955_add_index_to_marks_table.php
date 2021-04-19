<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropPrimary('id');

            $table->primary(['id','class_result_id','student_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropPrimary('subject_id');
            $table->dropPrimary('student_id');
            $table->dropPrimary('class_result_id');
            $table->dropPrimary('id');

            $table->primary('id');
        });
    }
}
