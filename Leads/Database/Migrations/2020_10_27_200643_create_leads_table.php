<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification_number')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('lead_status_id');
            $table->integer('department_id')->unsigned();
            $table->integer('subsidiary_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('lead_service_id')->unsigned()->nullable();
            $table->integer('lead_product_id')->unsigned()->nullable();
            $table->integer('lead_channel_id')->unsigned()->nullable();
            $table->integer('management_status_id')->unsigned()->nullable();
            $table->boolean('terms_and_conditions')->default(0);
            $table->integer('campaign_id')->unsigned()->nullable();
            $table->integer('type_of_credit')->unsigned()->nullable();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->foreign('lead_service_id')->references('id')->on('lead_services');
            $table->foreign('lead_product_id')->references('id')->on('lead_products');
            $table->foreign('lead_channel_id')->references('id')->on('lead_channels');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('management_status_id')->references('id')->on('management_statuses');
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
        Schema::dropIfExists('leads');
    }
}
