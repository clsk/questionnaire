<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueContraintToQuestionnaireAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaire_answers', function (Blueprint $table) {
            // There should only be one answer, per question, per questionnaire
            $table->unique(['questionnaire_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questionnaire_answers', function (Blueprint $table) {
            //
            $table->dropUnique(['questionnaire_id', 'question_id']);
        });
    }
}
