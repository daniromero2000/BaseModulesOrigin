<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterPaymentPromisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_payment_promises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('payment_promise',10,2);
            $table->unsignedInteger('subsidiary_id');
            $table->unsignedInteger('payment_promise_comment_id');
            $table->unsignedInteger('call_center_management_id');
            $table->date('promise_date');
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
        Schema::dropIfExists('call_center_payment_promises');
    }
}
