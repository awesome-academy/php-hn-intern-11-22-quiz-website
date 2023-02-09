<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Http\Requests\QuestionAndAnswerStoreRequest;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\QuizAnswer\QuizAnswerRepositoryInterface;
use App\Repositories\QuizQuestion\QuizQuestionRepositoryInterface;

class QuizQuestionController extends Controller
{
    /**
     * @var QuizRepositoryInterface
     */
    protected $quizRepo;

    /**
     * @var QuizAnswerRepositoryInterface
     */
    protected $quizAnswerRepo;

    /**
     * @var QuizQuestionRepositoryInterface
     */
    protected $quizQuestionRepo;

    public function __construct(
        QuizRepositoryInterface $quizRepo,
        QuizAnswerRepositoryInterface $quizAnswerRepo,
        QuizQuestionRepositoryInterface $quizQuestionRepo
    ) {
        $this->quizRepo = $quizRepo;
        $this->quizAnswerRepo = $quizAnswerRepo;
        $this->quizQuestionRepo = $quizQuestionRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = $this->quizRepo->find($id);

        return view('quizquestions.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Faker\View
     */
    public function create($id)
    {
        $quiz = $this->quizRepo->find($id);

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
        $request['number'] = $this->quizQuestionRepo->getNumQuestion($quiz);
        $question = $this->quizQuestionRepo->create($request->all());

        foreach ($request['answer'] as $key => $answer) {
            $enter['answer'] = $answer;
            if (array_search($key, $request['checkbox'])=== false) {
                $enter['correct'] = 0;
            } else {
                $enter['correct'] = 1;
            }
            $enter['quiz_question_id'] = $question->id;
            $this->quizAnswerRepo->create($enter);
        }

        return redirect()->route('quizzes.quizquestions.index', $quiz);
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
        $question = $this->quizQuestionRepo->find($id);

        return view('quizquestions.edit', compact('question'));
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
        $this->quizQuestionRepo->update($id, $request->all());
        $quizId = $this->quizQuestionRepo->getQuizId($id);

        return redirect()->route('quizzes.quizquestions.index', $quizId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->quizQuestionRepo->deleteQuestion($id);

        return redirect()->back();
    }
}
