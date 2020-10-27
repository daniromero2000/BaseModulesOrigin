<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoryReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_references', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referencetype_id');
            $table->string('reference_name',100);
            $table->string('reference_address',100);
            $table->string('reference_phone',11);
            $table->unsignedInteger('city_id');
            $table->softDeletes();
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
        Schema::dropIfExists('factory_references');
    }
}
