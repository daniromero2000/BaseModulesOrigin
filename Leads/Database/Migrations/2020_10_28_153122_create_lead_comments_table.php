<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_comments', function (Blueprint $table) {
            $table->integer('lead_id')->unsigned()->index();
            $table->string('comment');
            $table->integer('employee_id')->unsigned()->index();

            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('lead_comments');
    }
}
