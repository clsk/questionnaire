<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\QuestionnaireRepository;

class QuestionnaireController extends Controller
{
    //
    public function post(Request $request, Response $response)
    {
        // Validate input
        $request->validate([
            'answers' => 'required|array|min:1'
        ]);

        $answers = $request->input('answers');

        $questionnaireId = QuestionnaireRepository::createQuestionnaire(\Auth::user(), $answers);
        return response()->json(['questionnaire_id' => $questionnaireId]);
    }
}
