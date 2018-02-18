<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\QuestionRepository;

class QuestionRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItCreatesAQuestionCorrectly()
    {
        $questionText = 'What did you do today?';
        $model = QuestionRepository::createQuestion($questionText);
        $this->assertDatabaseHas('questions', [
          'text' => $questionText
        ]);
    }

    public function itFetchesAllQuestionsCorrectly() {
        $newQuestions = [
            'What did you do this morning?',
            'What did you have for breakfast today?',
            'How do you feel today?'
        ];

        // Create all questions
        foreach ($newQuestions as $question) {
            QuestionRepository::createQuestion($question);
        }

        $allQuestions = QuestionRepository::getAllQuestions();
        dd($allQuestions);
    }
}
