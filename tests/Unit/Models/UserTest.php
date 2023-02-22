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
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

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
        $quizzes = $this->user->quizzes();
        $this->assertHasManyRelation($quizzes, $this->user, new Quiz());
    }

    public function testTakesRelation()
    {
        $takes = $this->user->takes();
        $this->assertHasManyRelation($takes, $this->user, new Take());
    }

    public function testRoleRelation()
    {
        $role = $this->user->role();
        $this->assertBelongsToRelation($role, $this->user, new Role(), 'role_id');
    }

    public function testGetUnreadNotificationAttribute()
    {
        $this->user = new User();
        $this->assertIsNumeric($this->user->unread_notification);
    }

    public function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }
}
