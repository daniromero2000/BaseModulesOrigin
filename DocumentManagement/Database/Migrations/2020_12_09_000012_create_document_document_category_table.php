<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentDocumentCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_document_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_id')->index();
            $table->foreign('document_id')->references('id')->on('documents');
            $table->unsignedInteger('document_category_id')->index();
            $table->foreign('document_category_id')->references('id')->on('document_categories');
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
        Schema::dropIfExists('document_document_category');
    }
}
