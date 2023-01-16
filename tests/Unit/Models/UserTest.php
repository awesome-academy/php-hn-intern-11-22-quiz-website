<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;
use App\Models\Quiz;
use App\Models\Take;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new User(),
            [
                'username',
                'first_name',
                'last_name',
                'email',
                'password',
                'role_id',
            ],
            ['password'],
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
        $user = new User();
        $quizzes = $user->quizzes();
        $this->assertHasManyRelation($quizzes, $user, new Quiz());
    }

    public function testTakesRelation()
    {
        $user = new User();
        $takes = $user->takes();
        $this->assertHasManyRelation($takes, $user, new Take());
    }

    public function testRoleRelation()
    {
        $user = new User();
        $role = $user->role();
        $this->assertBelongsToRelation($role, $user, new Role(), 'role_id');
    }
}
