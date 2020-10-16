<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToCustomerEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_economic_activities', function (Blueprint $table) {
            $table->string('entity_commercial_name')->nullable()->after('entity_name');
            $table->integer('subsidiaries')->nullable()->after('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_economic_activities', function (Blueprint $table) {
            //
        });
    }
}
