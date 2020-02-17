<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->mediumText('address');
            $table->string('contactnumber');
            $table->string('sex');
            $table->date('bod');
            $table->string('civil_status')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('income')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('occupation');
            $table->string('nic',15)->nullable()->unique();
            $table->string('telephone',13)->nullable();
            $table->string('image')->default('dist/img/avatar.png');
            $table->timestamps();
            $table->primary('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
