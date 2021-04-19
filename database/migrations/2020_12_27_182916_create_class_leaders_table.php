<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_leaders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('leader_id');
            $table->uuid('clas_id');

            $table->foreign('clas_id')->references('id')->on('clas');
            $table->foreign('leader_id')->references('id')->on('leaders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_leaders');
    }
}
