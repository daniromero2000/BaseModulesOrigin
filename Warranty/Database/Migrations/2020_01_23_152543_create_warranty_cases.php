<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_type_id')->unsigned();
            $table->foreign('warranty_type_id')->references('id')->on('warranty_types');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->string('invoice', 50);
            $table->float('invoice_total', 13, 2);
            $table->string('product_reference', 100);
            $table->string('product_serial', 50);
            $table->string('product_name');
            $table->float('product_price', 13, 2);
            $table->text('product_accesories');
            $table->text('product_state');
            $table->tinyInteger('product_ubication')->default(0)->comment('0= Sucursal, 1= Domicilio');
            $table->timestamp('product_date_purchase');
            $table->string('product_sale_lote', 100);
            $table->integer('subsidiary_id')->unsigned();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->integer('item_failure_id')->unsigned();
            $table->foreign('item_failure_id')->references('id')->on('item_failures');
            $table->text('failure_description');
            $table->tinyInteger('type_purchase')->default(0)->comment('0= Crèdito, 1= Contado');
            $table->integer('warranty_manager_id')->unsigned();
            $table->foreign('warranty_manager_id')->references('id')->on('warranty_managers');
            $table->text('reason_deneid');
            $table->integer('warranty_solution_id')->unsigned();
            $table->foreign('warranty_solution_id')->references('id')->on('warranty_solutions');
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
        Schema::dropIfExists('warranty_cases');
    }
}