<?php
namespace App\Repositories\TakeAnswer;

use App\Repositories\BaseRepository;
use App\Models\TakeAnswer;

class TakeAnswerRepository extends BaseRepository implements TakeAnswerRepositoryInterface
{
    public function getModel()
    {
        return TakeAnswer::class;
    }

    public function createTakeAnswer($answer, $take_id, $quiz_question_id)
    {
        $takeAnswer = new TakeAnswer();
        $takeAnswer->answer = $answer;
        $takeAnswer->take_id = $take_id;
        $takeAnswer->quiz_question_id = $quiz_question_id;
        $takeAnswer->save();
        
        return $takeAnswer;
    }
}
