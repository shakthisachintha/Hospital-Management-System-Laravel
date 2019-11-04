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
            $table->string('occupation');
            $table->string('sex');
            $table->integer('age');
            $table->date('bod');
            $table->string('nic',15)->nullable()->unique();
            $table->string('telephone',13)->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
            $table->primary('id');
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
