<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInpatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inpatients', function (Blueprint $table) {
            //
            $table->date('discharged_date')->nullable();
            $table->string('description')->nullable();
            $table->string('discharged_officer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inpatients', function (Blueprint $table) {
            //
            $table->dropColumn('discharged_date')->nullable();
            $table->dropColumn('description')->nullable();
            $table->dropColumn('discharged_officer')->nullable();
        });
    }
}
