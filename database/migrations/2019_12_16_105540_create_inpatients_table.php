<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('patient_id');
            $table->char('discharged',4)->default('NO'); // YES | NO
            $table->bigInteger('ward_id');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->date('discharged_date')->nullable();
            $table->string('description')->nullable();
            $table->string('discharged_officer')->nullable();
            $table->string('patient_inventory')->nullable();
            $table->string('approved_doctor');
            $table->string('incharge_doctor');
            $table->string('house_doctor');
            $table->string('disease');
            $table->integer('duration');
            $table->string('condition');
            $table->string('certified_officer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inpatients');
    }
}
