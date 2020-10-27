<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->integer('warranty_type_id')->unsigned();
            $table->foreign('warranty_type_id')->references('id')->on('warranty_types');
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
        Schema::dropIfExists('warranty_documents');
    }
}