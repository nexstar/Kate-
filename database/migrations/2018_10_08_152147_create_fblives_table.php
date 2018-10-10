<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFblivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fblives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid');
            $table->string('title');
            $table->string('contents');
            $table->string('picjson');
            $table->string('saw');
            $table->string('path');
            $table->string('startdate');
            $table->string('starttime');
            $table->string('open');
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
        Schema::dropIfExists('fblives');
    }
}
