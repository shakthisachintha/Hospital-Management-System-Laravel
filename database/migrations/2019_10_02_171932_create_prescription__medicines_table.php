<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription__medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('prescription');
            $table->foreign('prescription')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->bigInteger('medicine');
            $table->foreign('medicine')->references('id')->on('medicines')->onDelete('cascade');
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
        Schema::dropIfExists('prescription__medicines');
    }
}
