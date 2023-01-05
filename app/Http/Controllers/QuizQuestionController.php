<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Http\Requests\QuestionAndAnswerStoreRequest;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quizquestions.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Faker\View
     */
    public function create($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quizquestions.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionAndAnswerStoreRequest $request, $quiz)
    {
        switch ($request['question_type']) {
            case "checkbox":
                $request['type'] = QuizQuestion::TYPE_CHECKBOX;
                break;
            case "radio":
                $request['type'] = QuizQuestion::TYPE_RADIO;
                break;
            case "text":
                $request['type'] = QuizQuestion::TYPE_TEXT;
                break;
        }

        $request['quiz_id'] = $quiz;
        $request['number'] = QuizQuestion::where('quiz_id', '=', $quiz)->count() + 1;
        $question = QuizQuestion::create($request->all());

        foreach ($request['answer'] as $key => $answer) {
            $enter['answer'] = $answer;
            if (array_key_exists($key, $request['checkbox'])) {
                $enter['correct'] = 1;
            } else {
                $enter['correct'] = 0;
            }
            $enter['quiz_question_id'] = $question->id;
            QuizAnswer::create($enter);
        }

        return redirect()->route('quizzes.show', $quiz);
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
