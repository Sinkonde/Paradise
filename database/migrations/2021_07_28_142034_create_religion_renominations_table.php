<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReligionRenominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('religion_renominations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('follower_name')->nullable();
            $table->string('country_division_name')->nullable(); //eg Kanisa Katholiki Tanzania
            $table->string('region_division_name')->nullable(); // eg Jimbo, Shenia
            $table->string('district_division_name')->nullable(); // eg Parokia
            $table->string('ward_division_name')->nullable(); // eg Kigango
            $table->string('family_division_name')->nullable(); // eg Jumuiya
            $table->uuid('religion_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('religion_id')->references('id')->on('religions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('religion_renominations');
    }
}
