<?php
namespace App\Repositories\Take;

use App\Repositories\RepositoryInterface;

interface TakeRepositoryInterface extends RepositoryInterface
{
    public function getQuiz($id);

    public function getTakeAnswers($id);

    public function createTake($score, $status, $user_id, $quiz_id);
}
