<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_statuses', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('status')->unique();
            $table->string('type_management_status')->default(0)->comment('0= Comercial, 1= Cartera');
            $table->boolean('is_active')->default(1)->comment('0= Inactivo, 1= Activo');
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
        Schema::dropIfExists('management_statuses');
    }
}
