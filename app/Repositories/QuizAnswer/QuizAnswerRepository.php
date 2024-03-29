<?php
namespace App\Repositories\QuizAnswer;

use App\Repositories\BaseRepository;
use App\Models\QuizAnswer;

class QuizAnswerRepository extends BaseRepository implements QuizAnswerRepositoryInterface
{
    public function getModel()
    {
        return QuizAnswer::class;
    }

    public function getQuizId($id)
    {
        return $this->model->findOrFail($id)->quizQuestion->quiz->id;
    }

    public function getTextAnswer($id)
    {
        return $this->model->where('quiz_question_id', $id)->first();
    }

    public function getCorrectAnswer($id)
    {
        return $this->model->where('quiz_question_id', $id)->where('correct', true)->count();
    }
}
