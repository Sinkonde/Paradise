<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('class_subject_id');
            $table->uuid('teacher_id');
            $table->integer('reference_no')->unique();
            $table->date('from');
            $table->date('to')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('class_subject_id')->references('id')->on('class_subjects');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_teachers');
    }
}
