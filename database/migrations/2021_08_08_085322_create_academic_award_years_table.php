<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicAwardYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_award_years', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('academic_award_id');
            $table->uuid('award_title_id');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('academic_award_id')->references('id')->on('academic_awards')->cascadeOnDelete();
            $table->foreign('award_title_id')->references('id')->on('award_titles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_award_years');
    }
}
