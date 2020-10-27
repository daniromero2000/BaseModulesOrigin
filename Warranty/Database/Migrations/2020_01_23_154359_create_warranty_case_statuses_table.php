<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCaseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_case_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 150);
            $table->string('color', 20);
            $table->tinyInteger('sequence')->default(0);
            $table->tinyInteger('editable')->default(0)->comment('0= No, 1= Si');
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
        Schema::dropIfExists('warranty_case_statuses');
    }
}
