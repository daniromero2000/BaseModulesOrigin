<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadManagementStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_management_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->unsigned()->index();
            $table->integer('management_status_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->index();

            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('management_status_id')->references('id')->on('management_statuses');
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
        Schema::dropIfExists('lead_management_status');
    }
}
