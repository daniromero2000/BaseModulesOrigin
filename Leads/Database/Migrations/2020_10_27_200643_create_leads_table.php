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
            $table->integer('lead_area_id')->unsigned();
            $table->integer('lead_service_id')->unsigned();
            $table->integer('lead_product_id')->unsigned();
            $table->integer('lead_channel_id')->unsigned();
            $table->integer('management_status_id')->unsigned();
            $table->boolean('terms_and_conditions')->default(0);

            $table->foreign('lead_area_id')->references('id')->on('lead_areas');
            $table->foreign('lead_service_id')->references('id')->on('lead_services');
            $table->foreign('lead_product_id')->references('id')->on('lead_products');
            $table->foreign('lead_channel_id')->references('id')->on('lead_channels');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('management_status_id')->references('id')->on('management_statuses');
            $table->tinyInteger('state');
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
        Schema::dropIfExists('leads');
    }
}
