<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyAmortizationTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_amortization_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_change_id')->unsigned();
            $table->foreign('warranty_change_id')->references('id')->on('warranty_changes');
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
        Schema::dropIfExists('warranty_amortization_tables');
    }
}
