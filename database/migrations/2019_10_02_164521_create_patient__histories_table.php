<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient__histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unique();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->longText('description');
            $table->string('bpm');
            $table->string('bp');
            $table->string('cholestrol');
            $table->string('blood_sugar');
            $table->bigInteger('doctor_in_charge');
            $table->foreign('doctor_in_charge')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient__histories');
    }
}
