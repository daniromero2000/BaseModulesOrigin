<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('call_center_schedule');
            $table->unsignedinteger('call_center_management_id');
            $table->unsignedinteger('call_center_comment_management_id');
            $table->unsignedInteger('employee_id');
            $table->softDeletes();
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
        Schema::dropIfExists('call_center_schedules');
    }
}
