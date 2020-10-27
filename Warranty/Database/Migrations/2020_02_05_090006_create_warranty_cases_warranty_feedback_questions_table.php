<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCasesWarrantyFeedbackQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_cases_warranty_feedback_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('warranty_case_id')->unsigned();
            $table->foreign('warranty_case_id', 'fk_case_response')->references('id')->on('warranty_cases');
            $table->integer('warranty_feedback_question_id')->unsigned();
            $table->foreign('warranty_feedback_question_id', 'fk_question_response')->references('id')->on('warranty_feedback_questions');
            $table->tinyInteger('response')->default(1);
            $table->unique(['warranty_case_id', 'warranty_feedback_question_id'], 'warranty_case_warranty_question_unique');
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
        Schema::dropIfExists('warranty_cases_warranty_feedback_questions');
    }
}
