<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->index()->after('courier_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedInteger('subsidiary_id')->index()->after('employee_id');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->unsignedInteger('company_id')->index()->after('subsidiary_id');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
        });
    }
}
