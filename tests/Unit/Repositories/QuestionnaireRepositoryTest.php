<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionnaireRepository;

class QuestionnaireRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    /**
     * Given:  that we have a number of questions in the database.
     * When:   I, as a User, choose an answer for each question in the database.
     * Then:   The system should store all my answers in the database.
     * @return void
     */
    public function testItCreatesAQuestionnaireCorrectly()
    {
        $questionsCount = 5;
        $answersCount = 5;

        // Create $questionsCount questions in the DB.
        // For each question, create $answerCount answers
        $questions = factory(\App\Models\Question::class, 5)->create()->each(function ($question) {
            $question->answers()->saveMany(factory(\App\Models\Answer::class, 5)->make());
        });

        $user = factory(\App\Models\User::class)->create();

        $questionsAnswers = [];
        foreach ($questions as $question) {
            $answers = $question->answers;
            $questionsAnswers[] = [
                'question_id' => $question->id,
                'answer_id' => $question->answers[rand(0, $answersCount-1)]->id
            ];
        }

       $questionnaire_id = QuestionnaireRepository::createQuestionnaire($user,
                                                                        array_map(function($qa) { return $qa['answer_id']; }, $questionsAnswers));

       // Make sure the questionnaire was created with the right user_id
       $this->assertDatabaseHas('questionnaires', [
           'id' => $questionnaire_id,
           'user_id' => $user->id
       ]);

        // Make sure the right answer is selected in DB for each question
        foreach ($questionsAnswers as $questionAnswer) {
            $this->assertDatabaseHas('questionnaire_answers', [
                'questionnaire_id' => $questionnaire_id,
                'question_id' => $questionAnswer['question_id'],
                'answer_id' => $questionAnswer['answer_id']
            ]);
        }
    }

    /**
     *  Given:  a time window
     *          AND that a user has responded to questions in that time window
     *          AND those responses are stored in the database
     *  When:   the user wants to analyze his response(s)
     *  Then:   we should be able to get ALL responses in that time window.
     */
    public function testItFetchesAllUserAnswersInTimeWindow() {
    }
}