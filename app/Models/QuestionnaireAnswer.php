<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class QuestionnaireAnswer extends Model
{
    //
    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer() {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

    public function questionnaire() {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }
}
