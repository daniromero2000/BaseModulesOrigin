<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyExchangeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_exchange_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_change_id')->unsigned();
            $table->foreign('warranty_change_id')->references('id')->on('warranty_changes');
            $table->string('product_name', 150);
            $table->string('product_reference', 40);
            $table->string('product_serial', 40);
            $table->string('product_sale_lote', 100);
            $table->float('product_price', 13,2);
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
        Schema::dropIfExists('warranty_exchange_items');
    }
}
