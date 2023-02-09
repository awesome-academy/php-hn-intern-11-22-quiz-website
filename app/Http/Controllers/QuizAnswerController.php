<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuizAnswer\QuizAnswerRepositoryInterface;

class QuizAnswerController extends Controller
{
    /**
     * @var QuizAnswerRepositoryInterface
     */
    protected $quizAnswerRepo;

    public function __construct(
        QuizAnswerRepositoryInterface $quizAnswerRepo
    ) {
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
    public function store(Request $request)
    {
        //
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
        $answer = $this->quizAnswerRepo->find($id);

        return view('quizanswers.edit', compact('answer'));
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
        $this->quizAnswerRepo->update($id, $request->all());
        $quizId = $this->quizAnswerRepo->getQuizId($id);

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
        $this->quizAnswerRepo->delete($id);
        
        return redirect()->back();
    }
}
