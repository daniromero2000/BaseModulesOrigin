<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_managements', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('alt');
            $table->string('url');
            $table->string('src');
            $table->string('sort_order');
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
        Schema::dropIfExists('banner_managements');
    }
}
