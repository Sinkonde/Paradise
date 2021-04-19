<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayscholarRouteYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayscholar_route_years', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('dayscholar_route_id');
            $table->uuid('academic_year_id');
            $table->timestamps();

            $table->foreign('dayscholar_route_id')->references('id')->on('dayscholar_routes');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dayscholar_route_years');
    }
}
