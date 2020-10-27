<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_case_id')->unsigned();
            $table->foreign('warranty_case_id')->references('id')->on('warranty_cases');
            $table->tinyInteger('state')->default(0)->comment('0= Pendiente, 1= Confirmado');
            // $table->tinyInteger('commercial_approval')->default(0)->comment('0= Pendiente, 1= Aprobado, 2= No aprobado');
            $table->tinyInteger('warranty_approval')->default(0)->comment('0= Pendiente, 1= Aprobado, 2= No aprobado');
            $table->float('total_price', 13, 2);
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
        Schema::dropIfExists('warranty_changes');
    }
}