<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('class_result_id');
            $table->uuid('student_id');
            $table->uuid('subject_id');
            $table->smallInteger('mark')->nullable();
            $table->timestamps();

            $table->foreign('class_result_id')->references('id')->on('class_results');
            $table->foreign('student_id')->references('id')->on('class_members');
            $table->foreign('subject_id')->references('id')->on('subject_teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
