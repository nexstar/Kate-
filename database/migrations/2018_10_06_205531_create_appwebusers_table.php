<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppwebusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appwebusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('webuserid');
            $table->string('email');
            $table->string('phone');
            $table->string('sex');
            $table->string('info');
            $table->string('web');
            $table->string('greenpetapp');
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
        Schema::dropIfExists('appwebusers');
    }
}
