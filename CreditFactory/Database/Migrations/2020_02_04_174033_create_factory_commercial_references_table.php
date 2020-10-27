<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoryCommercialReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_commercial_references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commercial_reference_name',100);
            $table->date('purchase_date');
            $table->string('item_purchased',100);
            $table->unsignedInteger('payment_habit');
            $table->unsignedInteger('share_value');
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
        Schema::dropIfExists('factory_commercial_references');
    }
}
