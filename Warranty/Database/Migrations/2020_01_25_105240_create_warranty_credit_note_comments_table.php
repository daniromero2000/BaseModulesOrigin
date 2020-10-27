<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCreditNoteCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_credit_note_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warranty_credit_note_id')->unsigned();
            $table->foreign('warranty_credit_note_id', 'fk_warranty_credit_note')->references('id')->on('warranty_credit_notes');
            $table->text('comment');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('warranty_credit_note_comments');
    }
}
