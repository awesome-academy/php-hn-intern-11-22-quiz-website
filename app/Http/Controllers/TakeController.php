<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Take;
use App\Models\TakeAnswer;
use App\Models\QuizQuestion;

class TakeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $score = Take::INITIAL_SCORE;
        $questions = Quiz::findOrFail($id)->quizQuestions;
        //calculate score
        foreach ($questions as $question) {
            switch ($question->type) {
                case QuizQuestion::TYPE_TEXT:
                    $answers = QuizAnswer::where('quiz_question_id', $question->id)->first();
                    $inputString = preg_replace('/\s+/', ' ', strtolower(head($request["answer$question->id"])));
                    if ($answers->answer === $inputString) {
                        $score ++;
                    }
                    break;
                case QuizQuestion::TYPE_CHECKBOX:
                    $correctAnswer = QuizAnswer::where('quiz_question_id', $question->id)
                        ->where('correct', true)->count();
                    foreach ($request["answer$question->id"] as $value) {
                        $answer = QuizAnswer::findOrFail($value);
                        if ($answer->correct) {
                            $correctAnswer --;
                        } else {
                            $correctAnswer ++;
                            break;
                        }
                    }
                    if (!$correctAnswer) {
                        $score ++;
                    }
                    break;
                case QuizQuestion::TYPE_RADIO:
                    $answer = QuizAnswer::findOrFail(head($request["answer$question->id"]));
                    if ($answer->correct) {
                        $score ++;
                    }
                    break;
            }
        }
        $take = new Take();
        $take->score = $score;
        $take->status = Take::STATUS_DONE;
        $take->user_id = auth()->id();
        $take->quiz_id = $id;
        $take->save();
        //store take answer
        foreach ($questions as $question) {
            foreach ($request["answer$question->id"] as $answer) {
                $takeAnswer = new TakeAnswer();
                $takeAnswer->answer = $answer;
                $takeAnswer->take_id = $take->id;
                $takeAnswer->quiz_question_id = $question->id;
                $takeAnswer->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
