<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('type',['private','public'])->default('private');
            $table->enum('total_marks',[50,100])->default(100);
            $table->uuid('academic_year');
            $table->uuid('user_id')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('academic_year')->references('id')->on('academic_years');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
