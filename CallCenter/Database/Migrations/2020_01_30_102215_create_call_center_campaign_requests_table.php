<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterCampaignRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_campaign_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('employee_id')->index();
            $table->string('campaign');
            $table->string('script')->nullable();
            $table->string('description')->nullable();
            $table->string('src')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_center_campaign_requests');
    }
}
