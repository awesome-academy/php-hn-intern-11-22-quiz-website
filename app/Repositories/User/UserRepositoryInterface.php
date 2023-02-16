<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getQuizzes($id);

    public function getTakes($id);

    public function getAdmins();
}
