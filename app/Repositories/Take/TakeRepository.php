<?php
namespace App\Repositories\Take;

use App\Repositories\BaseRepository;
use App\Models\Take;

class TakeRepository extends BaseRepository implements TakeRepositoryInterface
{
    public function getModel()
    {
        return Take::class;
    }

    public function getQuiz($id)
    {
        return $this->model->findOrFail($id)->quiz;
    }

    public function getTakeAnswers($id)
    {
        return $this->model->findOrFail($id)->takeAnswers;
    }

    public function createTake($score, $status, $user_id, $quiz_id)
    {
        $take = new Take();
        $take->score = $score;
        $take->status = $status;
        $take->user_id = $user_id;
        $take->quiz_id = $quiz_id;
        $take->save();
        
        return $take;
    }
}
