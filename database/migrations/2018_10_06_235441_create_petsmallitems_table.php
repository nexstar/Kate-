<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsmallitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petsmallitems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pethubid');
            $table->string('pethub');
            $table->string('petname');
            $table->string('kettles');
            $table->string('RoomTemps');
            $table->string('Temps');
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
        Schema::dropIfExists('petsmallitems');
    }
}
