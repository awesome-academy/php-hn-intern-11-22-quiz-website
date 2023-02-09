<?php
namespace App\Repositories\QuizAnswer;

use App\Repositories\RepositoryInterface;

interface QuizAnswerRepositoryInterface extends RepositoryInterface
{
    public function getQuizId($id);

    public function getTextAnswer($id);

    public function getCorrectAnswer($id);
}
