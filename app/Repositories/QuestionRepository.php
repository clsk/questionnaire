<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Answer;

class QuestionRepository {
  /**
   * Creates a new question in the Database
   * @param string $text The question's text
   * @param array<string> $answers array of answers
   * @return int id of question created
   */
  public static function createQuestion(string $text, array $answers) {
    try {
      $question = new Question(['text' => $text]);

      // Wrap instructions inside a DB transaction
      DB::beginTransaction();

      // Create objects in DB
      $question->save();
      $question->answers()->saveMany(array_map(function($answer) {
        return new Answer(['text' => $answer]);
      }, $answers));

      DB::commit();

      return $question->id;
    } catch (Exception $e) {
      DB::rollback();
      throw new \CreateQuestionException($e->getMessage());
    }
  }

  /**
   * Returns all questions in the database
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAllQuestions() {
    // Eager-load answers.
    // TODO: Should we do pagination here to be able handle a large of questions?
    return Question::with('answers')->get();
  }
}