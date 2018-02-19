<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionnaireRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = QuestionRepository::getAllQuestions()->toArray();
        return view('home', ['questions' => $questions]);
    }

    public function postQuestionnaire(Request $request)
    {
        $answers = $request->input('answers');
        QuestionnaireRepository::createQuestionnaire(\Auth::user(), $answers);
    }
}
