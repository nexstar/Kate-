<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('money');
            $table->string('pdbigitem');
            $table->string('pdsmallitem');
            $table->string('bouns');
            $table->string('inventory');
            $table->string('date');
            $table->string('contents');
            $table->string('src');
            $table->string('fe');
            $table->integer('discountstatus');
            $table->integer('onoff');
            $table->string('buycount');
            $table->string('point');
            $table->string('prompt');
            $table->string('addpd');
            $table->string('modelgc');
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
        Schema::dropIfExists('products');
    }
}
