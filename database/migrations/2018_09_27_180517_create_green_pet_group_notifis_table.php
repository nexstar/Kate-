<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenPetGroupNotifisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_pet_group_notifis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid');
            $table->string('title');
            $table->string('link');
            $table->string('picjson');
            $table->string('reservemdh');
            $table->string('fouritem');
            $table->string('contents');
            $table->string('notifi');
            $table->string('path');
            $table->string('depth');
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
        Schema::dropIfExists('green_pet_group_notifis');
    }
}
