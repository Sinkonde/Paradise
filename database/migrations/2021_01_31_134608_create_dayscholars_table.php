<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayscholarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayscholars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('route_id');
            $table->uuid('student_id');
            $table->date('from');
            $table->date('to')->nullable();
            $table->timestamps();

            $table->foreign('route_id')->references('id')->on('dayscholar_routes');
            $table->foreign('student_id')->references('id')->on('class_members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dayscholars');
    }
}
