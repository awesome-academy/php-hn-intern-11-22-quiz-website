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
    protected $quiz;

    public function setUp(): void
    {
        parent::setUp();
        $this->quiz = new Quiz();
    }

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
        $quizQuestions = $this->quiz->quizQuestions();
        $this->assertHasManyRelation($quizQuestions, $this->quiz, new QuizQuestion());
    }

    public function testTakesRelation()
    {
        $takes = $this->quiz->takes();
        $this->assertHasManyRelation($takes, $this->quiz, new Take());
    }

    public function testCategoryRelation()
    {
        $category = $this->quiz->category();
        $this->assertBelongsToRelation($category, $this->quiz, new Category(), 'category_id');
    }

    public function testUserRelation()
    {
        $user = $this->quiz->user();
        $this->assertBelongsToRelation($user, $this->quiz, new User(), 'user_id');
    }

    public function tearDown(): void
    {
        unset($this->quiz);
        parent::tearDown();
    }
}
