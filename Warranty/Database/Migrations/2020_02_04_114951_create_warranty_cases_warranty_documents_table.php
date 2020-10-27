<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCasesWarrantyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_cases_warranty_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('warranty_case_id')->unsigned();
            $table->foreign('warranty_case_id')->references('id')->on('warranty_cases');
            $table->integer('warranty_document_id')->unsigned();
            $table->foreign('warranty_document_id', 'fk_warranty_documents')->references('id')->on('warranty_documents');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('warranty_cases_warranty_documents');
    }
}
