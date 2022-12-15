<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            'user_id' => '2',
            'category_id' => '1',
            'title' => 'Famous Astronauts and Cosmonauts',
            'description' => 'Come and join to find out more about your favorite astronaut!!!',
        ]);
    }
}
