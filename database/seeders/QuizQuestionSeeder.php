<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_questions')->insert([
            'quiz_id' => '1',
            'type' => '1',
            'question' => 'Who was the second U.S. astronaut to travel into space?',
            'number' => '1',
        ]);
    }
}
