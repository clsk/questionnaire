<?php

namespace App\Repositories;

class QuestionnaireRepository {
  /**
   * Creates a new question in the Database
   * @param string $text The question's text
   * @return int id of question created
   */
  public static function createQuestionnaire(int $userId, array $answers) {
  }


  /**
   * Returns all questions in the database
   * @return Illuminate\Database\Eloquent\Collection
   */
  public static function getAllAnswersForUser(int $userId) {
  }
}