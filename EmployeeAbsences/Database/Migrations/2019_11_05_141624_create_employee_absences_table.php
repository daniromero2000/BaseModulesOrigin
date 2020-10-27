<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commentary', 250);
            $table->string('constancy');
            $table->date('start_date');
            $table->timestamp('finish_date');
            $table->string('state', 50)->default(0);
            $table->integer('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->integer('boss_id')->unsigned()->index();
            $table->foreign('boss_id')->references('id')->on('employees');
            $table->integer('reason_id')->unsigned()->index();
            $table->foreign('reason_id')->references('id')->on('reasons');
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
        Schema::dropIfExists('absences');
    }
}
