<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyInpatientTable extends Migration
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
            $table->string('patient_inventory')->nullable();
            $table->string('approved_doctor');
            $table->string('incharge_doctor');
            $table->string('house_doctor');
            $table->string('disease');
            $table->integer('duration');
            $table->string('condition');
            $table->string('certified_officer');
            $table->dropColumn('bed');

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
            $table->dropColumn('patient_inventory');
            $table->dropColumn('approved_doctor');
            $table->dropColumn('incharge_doctor');
            $table->dropColumn('house_doctor');
            $table->dropColumn('disease');
            $table->dropColumn('duration');
            $table->dropColumn('condition');
            $table->dropColumn('certified_officer');
            $table->integer('bed')->nullable();
        });
    }
}
