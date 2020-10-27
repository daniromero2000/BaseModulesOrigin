<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_quotes', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id', 'fk_customer_quotes')->references('id')->on('customers');
            $table->integer('insurance_policy_id')->unsigned();
            $table->foreign('insurance_policy_id', 'fk_policy_quotes')->references('id')->on('insurance_policies');
            $table->integer('insurance_carrier_id')->unsigned();
            $table->foreign('insurance_carrier_id', 'fk__quotes')->references('id')->on('insurance_carriers');
            $table->float('price', 13,2);

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
        Schema::dropIfExists('policy_quotes');
    }
}
