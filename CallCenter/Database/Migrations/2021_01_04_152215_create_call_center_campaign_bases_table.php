<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterCampaignBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_campaign_bases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_number',13);
            $table->string('name')->default('NA');
            $table->timestamp('birthday');
            $table->string('city')->default('NA');
            $table->string('province')->default('NA');
            $table->string('address')->default('NA');
            $table->string('telephone1')->default('NA');
            $table->string('telephone2')->default('NA');
            $table->string('mobil1')->default('NA');
            $table->string('mobil2')->default('NA');
            $table->string('type')->default('NA');
            $table->unsignedinteger('employee_id')->index();
            $table->unsignedInteger('campaign_id');
            $table->unsignedinteger('call_center_status_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('call_center_campaigns');
            $table->foreign('call_center_status_id')->references('id')->on('call_center_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_center_campaign_bases');
    }
}
