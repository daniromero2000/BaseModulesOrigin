<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('contact', 100);
            $table->string('telphone', 30);
            $table->tinyInteger('type')->default(0)->comment('0= Marca, 1= Centro de servicio, 2= Aseguradora');
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
        Schema::dropIfExists('warranty_managers');
    }
}
