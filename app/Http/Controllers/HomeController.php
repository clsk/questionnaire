<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $summary = QuestionnaireRepository::getAnswersSummary(\Auth::user());
        return view('home', ['questions' => $questions, 'summary' => $summary]);
    }
}
