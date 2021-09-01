<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_awards', function (Blueprint $table) {
            //Awards descriptions
            //It carries academic_year
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('academic_year_id');
            $table->date('issue_date')->nullable();
            $table->string('place')->nullable();

            $table->timestamps();

            $table->foreign('academic_year_id')->references('id')->on('academic_years')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_awards');
    }
}
