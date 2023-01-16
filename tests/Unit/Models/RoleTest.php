<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class RoleTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(new Role());
    }

    public function testUsersRelation()
    {
        $role = new Role();
        $users = $role->users();
        $this->assertHasManyRelation($users, $role, new User());
    }
}
