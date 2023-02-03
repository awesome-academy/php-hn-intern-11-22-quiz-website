<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    protected $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Category(),
            ['name'],
            [],
            ['*'],
            [],
            [
                'id' => 'int',
                'deleted_at' => 'datetime',
            ]
        );
    }

    public function testQuizzesRelation()
    {
        $quizzes = $this->category->quizzes();
        $this->assertHasManyRelation($quizzes, $this->category, new Quiz());
    }

    public function tearDown(): void
    {
        unset($this->category);
        parent::tearDown();
    }
}
