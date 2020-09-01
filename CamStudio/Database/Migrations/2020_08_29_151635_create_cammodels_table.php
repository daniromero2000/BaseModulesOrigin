<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->integer('manager_id')->unsigned();
            $table->foreign('manager_id')->references('id')->on('employees')->onDelete('cascade');
            $table->tinyInteger('fake_age')->unsigned()->default(18);
            $table->string('nickname');
            $table->string('height')->default(0);
            $table->string('weight')->default(0);
            $table->string('breast_cup_size')->default(0);
            $table->text('tattoos_piercings');
            $table->text('meta');
            $table->text('likes_dislikes');
            $table->text('about_me');
            $table->text('private_show');
            $table->text('my_rules');
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
        Schema::dropIfExists('cammodels');
    }
}
