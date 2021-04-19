<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFeeStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_structures', function (Blueprint $table) {
            if (Schema::hasColumn('fee_structures', 'from') and Schema::hasColumn('fee_structures', 'to')) {
                $table->dropColumn(['from', 'to']);
            }

            if (!Schema::hasColumn('fee_structures', 'serial_no')) {
                $table->tinyInteger('serial_no');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_structures', function (Blueprint $table) {

            if (!Schema::hasColumn('fee_structures', 'from') and !Schema::hasColumn('fee_structures', 'to')) {
                $table->date('from');
                $table->date('to');
            }

            if (Schema::hasColumn('fee_structures', 'serial_no')) {
                $table->dropColumn('serial_no');
            }
        });
    }
}
