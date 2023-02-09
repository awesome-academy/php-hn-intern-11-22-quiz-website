<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use App\Models\Take;
use App\Models\TakeAnswer;
use App\Models\QuizQuestion;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\Take\TakeRepositoryInterface;
use App\Repositories\TakeAnswer\TakeAnswerRepositoryInterface;
use App\Repositories\QuizAnswer\QuizAnswerRepositoryInterface;

class TakeController extends Controller
{
    /**
     * @var QuizRepositoryInterface
     */
    protected $quizRepo;
    /**
     * @var TakeRepositoryInterface
     */
    protected $takeRepo;
    /**
     * @var TakeAnswerRepositoryInterface
     */
    protected $takeAnswerRepo;
    /**
     * @var QuizAnswerRepositoryInterface
     */
    protected $quizAnswerRepo;

    public function __construct(
        QuizRepositoryInterface $quizRepo,
        TakeRepositoryInterface $takeRepo,
        TakeAnswerRepositoryInterface $takeAnswerRepo,
        QuizAnswerRepositoryInterface $quizAnswerRepo
    ) {
        $this->quizRepo = $quizRepo;
        $this->takeRepo = $takeRepo;
        $this->takeAnswerRepo = $takeAnswerRepo;
        $this->quizAnswerRepo = $quizAnswerRepo;
    }

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
        $questions = $this->quizRepo->getQuestions($id);
        //calculate score
        foreach ($questions as $question) {
            switch ($question->type) {
                case QuizQuestion::TYPE_TEXT:
                    $answers = $this->quizAnswerRepo->getTextAnswer($question->$id);
                    $inputString = preg_replace('/\s+/', ' ', strtolower(head($request["answer$question->id"])));
                    if ($answers->answer === $inputString) {
                        $score ++;
                    }
                    break;
                case QuizQuestion::TYPE_CHECKBOX:
                    $correctAnswer = $this->quizAnswerRepo->getCorrectAnswer($question->id);
                    foreach ($request["answer$question->id"] as $value) {
                        $answer = $this->quizAnswerRepo->find($value);
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
                    $answer = $this->quizAnswerRepo->find(head($request["answer$question->id"]));

                    if ($answer->correct) {
                        $score ++;
                    }
                    break;
            }
        }
        $take = $this->takeRepo->createTake($score, Take::STATUS_DONE, auth()->id(), $id);
        //store take answer
        foreach ($questions as $question) {
            foreach ($request["answer$question->id"] as $answer) {
                $this->takeAnswerRepo->createTakeAnswer($answer, $take->id, $question->id);
            }
        }

        return redirect()->route('takes.show', $take->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $take = $this->takeRepo->find($id);
        $quiz = $this->takeRepo->getQuiz($id);
        $takeAnswers = $this->takeRepo->getTakeAnswers($id);

        return view('takes.show', compact(['take', 'quiz', 'takeAnswers']));
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
