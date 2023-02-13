<?php
namespace App\Repositories\QuizQuestion;

use App\Repositories\BaseRepository;
use App\Models\QuizQuestion;
use DB;

class QuizQuestionRepository extends BaseRepository implements QuizQuestionRepositoryInterface
{
    public function getModel()
    {
        return QuizQuestion::class;
    }

    public function getQuizId($id)
    {
        return $this->model->findOrFail($id)->quiz->id;
    }

    public function getNumQuestion($id)
    {
        $cnt = $this->model->where('quiz_id', '=', $id)->count();
        $cnt++;
        
        return $cnt;
    }

    public function deleteQuestion($id)
    {
        $quizQuestion = $this->model->findOrFail($id);
        if ($quizQuestion) {
            DB::beginTransaction();
            try {
                $quizQuestion->quizAnswers()->delete();
                $quizQuestion->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();

                return false;
            }

            return true;
        }

        return false;
    }
}
