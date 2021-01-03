<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClinicPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patients_id');
            $table->bigInteger('clinic_id')->unsigned();
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('patients_id')->references('id')->on('patients');
            $table->timestamps();
        });
        DB::unprepared('ALTER TABLE clinic_patient ADD UNIQUE KEY(`patients_id`,`clinic_id`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('clinic_patient');
    }
}
