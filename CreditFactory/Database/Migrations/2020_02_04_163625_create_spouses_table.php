<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spouse_identity_number');
            $table->string('spouse_name');
            $table->string('spouse_adress');
            $table->string('spouse_phone');
            $table->unsignedInteger('epss_id');
            $table->string('spouse_business');
            $table->string('spouse_profession');
            $table->string('spouse_income');
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
        Schema::dropIfExists('spouses');
    }
}
