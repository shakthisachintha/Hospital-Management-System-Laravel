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
            $table->char('birth_place');
            $table->char('nationality');
            $table->char('religion');
            $table->bigInteger('monthly_income');
            $table->char('guardian');
            $table->char('guardian_address');
            $table->char('inventory');

            $table->date('date');
            $table->time('time');
            $table->char('approved_doctor');
            $table->char('ward_doctor');

            $table->char('disease');
            $table->char('duration');
            $table->char('condition');
            $table->char('certified_by');
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
            $table->dropColumn('birth_place');
            $table->dropColumn('nationality');
            $table->dropColumn('religion');
            $table->dropColumn('monthly_income');
            $table->dropColumn('guardian');
            $table->dropColumn('guardian_address');
            $table->dropColumn('inventory');

            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('approved_doctor');
            $table->dropColumn('ward_doctor');

            $table->dropColumn('disease');
            $table->dropColumn('duration');
            $table->dropColumn('condition');
            $table->dropColumn('certified_by');
        });
    }
}
