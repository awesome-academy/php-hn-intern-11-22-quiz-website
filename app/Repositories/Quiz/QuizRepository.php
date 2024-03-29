<?php
namespace App\Repositories\Quiz;

use App\Repositories\BaseRepository;
use DB;
use App\Models\Quiz;
use Carbon\Carbon;

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

    public function getStatistic()
    {
        $year = Carbon::now()->year;
        $initChart = config('init-chart.data');
        $quizList = $this->model->where('created_at', 'like', "%" . $year . "%")->get();

        foreach ($initChart as $month => $value) {
            foreach ($quizList as $item) {
                if ($item->created_at->format('M') == $month) {
                    $initChart[$month]++;
                }
            }
        }

        return json_encode(array_merge($initChart));
    }

    public function getTodayQuiz()
    {
        return $this->model->whereDate('created_at', Carbon::now()->toDateString())->count();
    }
}
