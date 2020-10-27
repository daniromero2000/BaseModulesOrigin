<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_citations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_case_id')->unsigned();
            $table->foreign('warranty_case_id')->references('id')->on('warranty_cases');
            $table->tinyInteger('state')->default(0)->comment('0: En proceso, 1: Resuelto');
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
        Schema::dropIfExists('warranty_citations');
    }
}
