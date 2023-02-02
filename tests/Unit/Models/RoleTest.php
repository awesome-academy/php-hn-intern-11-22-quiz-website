<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class RoleTest extends ModelTestCase
{
    protected $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(new Role());
    }

    public function testUsersRelation()
    {
        $users = $this->role->users();
        $this->assertHasManyRelation($users, $this->role, new User());
    }

    public function tearDown(): void
    {
        unset($this->role);
        parent::tearDown();
    }
}
