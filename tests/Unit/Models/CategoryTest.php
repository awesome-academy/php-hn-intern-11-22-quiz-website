<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
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
        $category = new Category();
        $quizzes = $category->quizzes();
        $this->assertHasManyRelation($quizzes, $category, new Quiz());
    }
}
