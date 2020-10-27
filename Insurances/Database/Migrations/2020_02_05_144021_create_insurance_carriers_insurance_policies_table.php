<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceCarriersInsurancePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_carriers_insurance_policies', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('insurance_carrier_id')->unsigned();
            $table->foreign('insurance_carrier_id', 'fk_insurance_carriers_policies')->references('id')->on('insurance_carriers');
            $table->integer('insurance_policy_id')->unsigned();
            $table->foreign('insurance_policy_id', 'fk_insurance_policy')->references('id')->on('insurance_policies');
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
        Schema::dropIfExists('insurance_carriers_insurance_policies');
    }
}
