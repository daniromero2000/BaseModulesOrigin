<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_number',13);
            $table->string('name_answer',100);
            $table->string('email_answer',100)->nullable();
            $table->unsignedInteger('comment_id');
            $table->foreign('comment_id')->references('id')->on('call_center_comment_managements');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('call_center_campaigns');
            $table->unsignedInteger('script_id');
            $table->foreign('script_id')->references('id')->on('call_center_scripts');
            $table->unsignedInteger('call_qualification_id');
            $table->foreign('call_qualification_id')->references('id')->on('call_center_call_qualifications');
            $table->unsignedInteger('management_indicator_id');
            $table->foreign('management_indicator_id')->references('id')->on('call_center_management_indicators');
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
        Schema::dropIfExists('call_center_managements');
    }
}
