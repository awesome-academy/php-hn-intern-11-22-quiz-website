<?php
namespace App\Repositories\QuizQuestion;

use App\Repositories\RepositoryInterface;

interface QuizQuestionRepositoryInterface extends RepositoryInterface
{
    public function getQuizId($id);

    public function getNumQuestion($id);

    public function deleteQuestion($id);
}
