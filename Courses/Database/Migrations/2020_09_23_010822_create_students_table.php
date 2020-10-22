<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_type');
            $table->string('identification')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('position')->nullable()->default('No Position');
            $table->string('email')->nullable()->default('No Email');
            $table->string('phone')->nullable()->default('No Phone');
            $table->string('hotel_name')->default('No Name');
            $table->string('hotel_city')->default('No City');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('students');
    }
}
