<?php

use Illuminate\Database\Seeder;
use App\Repositories\QuestionRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'text' => 'What did you do this morning?',
                'answers' => [
                    'Nothing',
                    'Had breakfast',
                    'Went for a run',
                    'Went straight to work'
                ]
            ],
            [
                'text' => 'What did you have for breakfast today?',
                'answers' => [
                    'Eggs',
                    'Muffins',
                    'Sandwich',
                    'Coffee'
                ]
            ],
            [
                'text' => 'How do you feel today?',
                'answers' => [
                    'Very good',
                    'Good',
                    'OK',
                    'Bad',
                    'Very bad'
                ]
            ],
            [
                'text' => 'How many miles did you run this morning?',
                'answers' => [
                    '0 mi',
                    '0.5 mi',
                    '1 - 3 mi',
                    '3 - 5 mi',
                    '5 - 10 mi'
                ]
            ]
        ];

        foreach ($questions as $question) {
            QuestionRepository::createQuestion($question['text'], $question['answers']);
        }
    }
}
