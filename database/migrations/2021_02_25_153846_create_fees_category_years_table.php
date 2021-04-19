<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesCategoryYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_category_years', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fees_category_id');
            $table->uuid('academic_year_id');
            $table->timestamps();

            $table->foreign('fees_category_id')->references('id')->on('fees_categories')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees_category_years');
    }
}
