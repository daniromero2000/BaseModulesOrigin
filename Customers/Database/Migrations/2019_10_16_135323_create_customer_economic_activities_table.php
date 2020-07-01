<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_economic_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('economic_activity_type_id')->unsigned()->index();
            $table->foreign('economic_activity_type_id')->references('id')->on('economic_activity_types');
            $table->string('entity_name');
            $table->integer('professions_list_id')->unsigned()->index();
            $table->foreign('professions_list_id')->references('id')->on('professions_lists');
            $table->date('start_date');
            $table->integer('incomes');
            $table->integer('other_incomes');
            $table->text('other_incomes_source');
            $table->integer('expenses');
            $table->string('entity_address');
            $table->string('entity_phone');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('customer_economic_activities');
    }
}
