<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Weeeeeeee',
            'password' => Hash::make('password'),
            'first_name' => 'Huy',
            'last_name' => 'Pham',
            'role_id' => '2'
        ]);

        User::factory(10)->create();
    }
}
