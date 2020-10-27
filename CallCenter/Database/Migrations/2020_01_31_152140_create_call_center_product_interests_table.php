<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterProductInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_product_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_line_id');
            $table->unsignedInteger('call_center_management_id');
            $table->unsignedInteger('call_center_product_interest_comment_id');
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
        Schema::dropIfExists('call_center_product_interests');
    }
}
