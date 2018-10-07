<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenPetBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green_pet_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('src');
            $table->string('fe');
            $table->string('link');
            $table->string('contents');
            $table->string('notifi');
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
        Schema::dropIfExists('green_pet_blogs');
    }
}
