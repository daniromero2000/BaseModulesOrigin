<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListpriceSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listprice_subsidiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_listprice');
            $table->unsignedInteger('id_subsidiary');     
            $table->float('price');
            $table->float('tax');
            $table->integer('deviation_high');
            $table->integer('deviation_less');
            $table->dateTime('since');
            $table->dateTime('until');
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
        Schema::dropIfExists('listprice_subsidiaries');
    }
}
