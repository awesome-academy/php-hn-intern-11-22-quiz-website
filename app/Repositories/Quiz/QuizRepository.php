<?php
namespace App\Repositories\Quiz;

use App\Repositories\BaseRepository;
use DB;
use App\Models\Quiz;

class QuizRepository extends BaseRepository implements QuizRepositoryInterface
{
    public function getModel()
    {
        return Quiz::class;
    }

    public function getQuiz($id)
    {
        return $this->model->where('id', '=', $id)->first();
    }

    public function deleteQuiz($id)
    {
        $result = $this->model->findOrFail($id);
        if ($result) {
            DB::beginTransaction();
            try {
                foreach ($result->quizQuestions as $question) {
                    $question->quizAnswers()->delete();
                }
                foreach ($result->takes as $take) {
                    $take->takeAnswers()->delete();
                }
                $result->quizquestions()->delete();
                $result->takes()->delete();
                $result->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();

                return false;
            }

            return true;
        }

        return false;
    }

    public function getQuestions($id)
    {
        return $this->model->findOrFail($id)->quizQuestions;
    }
}
