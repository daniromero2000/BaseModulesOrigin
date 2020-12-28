<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->unsigned();
            $table->string('kind_of_person')->nullable();
            $table->string('entity')->nullable();
            $table->string('amount')->nullable();
            $table->string('term')->nullable();
            $table->string('expiration_date_soat')->nullable();
            $table->integer('subsidiary_id')->unsigned()->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_informations');
    }
}
