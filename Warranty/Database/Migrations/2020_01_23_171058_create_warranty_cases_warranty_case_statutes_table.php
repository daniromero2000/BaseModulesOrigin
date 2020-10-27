<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCasesWarrantyCaseStatutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_cases_warranty_case_statutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('warranty_case_id')->unsigned();
            $table->foreign('warranty_case_id')->references('id')->on('warranty_cases');
            $table->integer('warranty_case_status_id')->unsigned();
            $table->foreign('warranty_case_status_id', 'fk_warranty_case_status')->references('id')->on('warranty_case_statuses');
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
        Schema::dropIfExists('warranty_cases_warranty_case_statutes');
    }
}
