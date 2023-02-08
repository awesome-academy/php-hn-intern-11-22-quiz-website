<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getQuizzes($id)
    {
        return $this->model->findOrFail($id)->quizzes;
    }
}
