<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_group_id')->unsigned()->nullable();
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('set null');
            $table->string('name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('scholarity_id')->unsigned();
            $table->foreign('scholarity_id')->references('id')->on('scholarities');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('customer_channel_id')->unsigned();
            $table->foreign('customer_channel_id')->references('id')->on('customer_channels');
            $table->integer('civil_status_id')->unsigned();
            $table->foreign('civil_status_id')->references('id')->on('civil_statuses');
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->integer('customer_status_id')->unsigned()->default(3);
            $table->foreign('customer_status_id')->references('id')->on('customer_statuses');
            $table->boolean('data_politics')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->boolean('subscribed_to_news_letter')->default(0);
            $table->string('avatar')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
