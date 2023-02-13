<?php
namespace App\Repositories\Quiz;

use App\Repositories\RepositoryInterface;

interface QuizRepositoryInterface extends RepositoryInterface
{
    public function getQuiz($id);

    public function deleteQuiz($id);

    public function getQuestions($id);

    public function getStatistic();
}
