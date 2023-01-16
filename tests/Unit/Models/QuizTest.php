<?php

namespace Tests\Unit;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use App\Models\Take;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class QuizTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Quiz(),
            [
                'title',
                'description',
                'category_id',
                'user_id',
            ],
            [],
            ['*'],
            [],
            [
                'id' => 'int',
                'deleted_at' => 'datetime',
            ]
        );
    }

    public function testQuizQuestionsRelation()
    {
        $quiz = new Quiz();
        $quizQuestions = $quiz->quizQuestions();
        $this->assertHasManyRelation($quizQuestions, $quiz, new QuizQuestion());
    }

    public function testTakesRelation()
    {
        $quiz = new Quiz();
        $takes = $quiz->takes();
        $this->assertHasManyRelation($takes, $quiz, new Take());
    }

    public function testCategoryRelation()
    {
        $quiz = new Quiz();
        $category = $quiz->category();
        $this->assertBelongsToRelation($category, $quiz, new Category(), 'category_id');
    }

    public function testUserRelation()
    {
        $quiz = new Quiz();
        $user = $quiz->user();
        $this->assertBelongsToRelation($user, $quiz, new User(), 'user_id');
    }
}
