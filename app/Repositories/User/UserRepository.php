<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getQuizzes($id)
    {
        return $this->model->findOrFail($id)->quizzes;
    }

    public function getTakes($id)
    {
        return $this->model->findOrFail($id)->takes;
    }

    public function getAdmins()
    {
        return $this->model->where('role_id', User::ROLE_ADMIN)->get();
    }
}
