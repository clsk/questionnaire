<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class QuestionRepository {
  /**
   * Creates a new question in the Database
   * @param string $text The question's text
   * @return int id of question created
   */
  public static function createQuestion(string $text) {
    try {
      return DB::table('questions')->insertGetId(['text' => $text]);
    } catch (Exception $e) {
      throw $e;
    }
  }


  /**
   * Returns all questions in the database
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAllQuestions() {
  }
}