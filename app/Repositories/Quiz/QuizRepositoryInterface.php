<?php
namespace App\Repositories\Quiz;

use App\Repositories\RepositoryInterface;

interface QuizRepositoryInterface extends RepositoryInterface
{
    public function getQuiz($id);

    public function deleteQuiz($id);
}
