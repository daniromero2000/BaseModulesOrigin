<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallCenterQuestionnaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_center_questionnaire_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('id_call_center_questionnaire');
            $table->string('question');
            $table->string('typeAnswer');
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
        Schema::dropIfExists('call_center_questionnaire_questions');
    }
}
