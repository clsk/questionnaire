<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\QuestionnaireAnswer;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;


class QuestionnaireRepository {
  /**
   * Creates a new question in the Database
   * @param User $user User that responded this questionnaire
   * @return int id of questionnaire row created
   */
  public static function createQuestionnaire(User $user, array $answerIds) {
    /**
     * @todo Validate $user is not null
     * @todo Validate $answerIds is not null or empty
     */
    try {
      $questionnaire = new Questionnaire(['user_id' => $user->id]);

      // Wrap instructions inside a DB transaction
      DB::beginTransaction();

      // Create objects in DB
      $questionnaire->save();

      $questionnaire->answers()->saveMany(array_map(function($answerId) use($questionnaire) {
        $answer = Answer::with('question')->where('id', $answerId)->firstOrFail();
        $questionnaireAnswer = new QuestionnaireAnswer([
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
   * Returns all questionnaires (set of answers) by user in given time window
   * @param User $user 
   * @param DateTime $from 
   * @param DateTime $to 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAllAnswersForUser(User $user, Carbon $from = null, Carbon $to = null) {
    /**
     * @todo Validate $from is not in the future
     * @todo Validate $to is not in the future
     * @todo Validate $user is not null
     */
    $query = QuestionnaireAnswer::whereHas('questionnaire', function($q) use($user) {
      $q->whereHas('user', function ($q) use ($user) {
        $q->where('id', $user->id);
      });
    });

    if (is_null($from) === false) {
      $query->where('created_at', '>=', $from);
    }

    if (is_null($to) === false) {
      $query->where('created_at', '<=', $to);
    }

    return $query->with('answer')->get();
  }

  /**
   * Returns a summary of the user's response
   * @param User $user 
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAnswersSummary(User $user) {
    $query = DB::table('answers')->select(
      'question_id', 'questions.text AS question_text', 'answers.id AS answer_id', 'answers.text AS answer_text',
      DB::raw('(
        SELECT COUNT(*)
        FROM questionnaire_answers
        LEFT JOIN questionnaires ON questionnaire_answers.questionnaire_id=questionnaires.id
        WHERE answer_id=answers.id AND questionnaires.user_id=?
      )')
    );
    $query->addBinding($user->id, 'select');
    $query = $query->rightJoin('questions', 'answers.question_id', '=', 'questions.id')->orderBy('question_id');

    $dbResults = $query->get();

    $questions = [];
    // Build arrays
    foreach ($dbResults as $dbResult) {
      if (array_key_exists($dbResult->question_id, $questions)) {
        $questions[$dbResult->question_id]['answers'][] = [
          'id' => $dbResult->answer_id,
          'text' => $dbResult->answer_text,
          'count' => $dbResult->count
        ];
      } else {
        $questions[$dbResult->question_id] = [
          'id' => $dbResult->question_id,
          'text' => $dbResult->question_text,
          'answers' => [
            [
              'id' => $dbResult->answer_id,
              'text' => $dbResult->answer_text,
              'count' => $dbResult->count
            ]
          ]
        ];
      }
    }

    return $questions;
  }
}