<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\QuestionnaireAnswer;
use App\Models\Question;
use App\Models\User;


class QuestionnaireRepository {
  /**
   * Creates a new question in the Database
   * @param User $user User that responded this questionnaire
   * @return int id of questionnaire row created
   */
  public static function createQuestionnaire(User $user, array $answerIds) {
    try {
      $questionnaire = new Questionnaire(['user_id' => $user->id]);

      // Wrap instructions inside a DB transaction
      DB::beginTransaction();

      // Create objects in DB
      $questionnaire->save();

      $questionnaire->answers()->saveMany(array_map(function($answerId) use($questionnaire) {
        $answer = Answer::with('question')->where('id', $answerId)->firstOrFail();
        $questionnaireAnswer = new QuestionnaireAnswer([
          'question_id' => $answer->question->id,
          'answer_id' => $answer->id,
          'questionnaire_id' => $questionnaire->id
        ]);

        return $questionnaireAnswer;
      }, $answerIds));

      DB::commit();

      return $questionnaire->id;
    } catch (Exception $e) {
      DB::rollback();
      throw new \CreateQuestionException($e->getMessage());
    }
  }


  /**
   * Returns all questions in the database
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAllAnswersForUser(int $userId) {
  }
}