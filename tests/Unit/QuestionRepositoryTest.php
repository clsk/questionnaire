<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\QuestionRepository;

class QuestionRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    /**
     * Given:  that we have a quesiton and set of answers we'd like to add to the database.
     * When:   we insert it into the database using the QuestionRepository
     * Then:   it should be present in the database when we attempt to retrieve it
     * @return void
     */
    public function testItCreatesAQuestionCorrectly()
    {
        $questionText = 'What did you do today?';
        $answers = [
            'Go for a run',
            'Went to work',
            'Sleep all day'
        ];

        $questionId = QuestionRepository::createQuestion($questionText, $answers);
        // Make sure question was created with right text
        $this->assertDatabaseHas('questions', [
          'text' => $questionText
        ]);

        // Make sure all answers were created with the right text
        foreach ($answers as $answer) {
            $this->assertDatabaseHas('answers', [
                'question_id' => $questionId,
                'text' => $answer
            ]);
        }
    }

    /**
     *  Given:  that there X number of questions (and answers) in the database
     *  When:   we want to show ALL questions and answers to the user
     *  Then:   we should get ALL questions and possible answers to show to the user.
     */
    public function testItFetchesAllQuestionsInDatabase() {
        $questionsCount = 5;
        $answersCount = 5;

        // Create $questionsCount questions in the DB.
        // For each question, create $answerCount answers
        factory(\App\Models\Question::class, 5)->create()->each(function ($question) {
            $question->answers()->saveMany(factory(\App\Models\Answer::class, 5)->make());
        });

        // Get all questions and possible answers
        $allQuestions = QuestionRepository::getAllQuestions();

        // Assert that we get $questionsCount questions. And, $answerCount answers, for each question.
        $this->assertEquals($questionsCount, $allQuestions->count());
        foreach ($allQuestions as $question) {
            $this->assertEquals($answersCount, $question->answers()->count());
        }
    }
}
