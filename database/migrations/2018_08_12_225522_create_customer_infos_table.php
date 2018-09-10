<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('privatemobile');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('engname');
            $table->string('nickname');
            $table->string('birthday');
            $table->string('sex');
            $table->string('age');
            $table->string('countryregion');
            $table->string('homeindoorphone');
            $table->string('homeaddress');
            $table->string('privatemail');
            $table->string('companyname');
            $table->string('companybranch');
            $table->string('companytitle');
            $table->string('companyvat');
            $table->string('companyindoorphone');
            $table->string('companyaddress');
            $table->string('companymail');
            $table->string('companyweb');
            $table->string('companyfax');
            $table->string('companytelephone');
            $table->string('companymobile');
            $table->string('remark');
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
        Schema::dropIfExists('customer_infos');
    }
}
