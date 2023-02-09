<?php
namespace App\Repositories\TakeAnswer;

use App\Repositories\RepositoryInterface;

interface TakeAnswerRepositoryInterface extends RepositoryInterface
{
    public function createTakeAnswer($answer, $take_id, $quiz_question_id);
}
