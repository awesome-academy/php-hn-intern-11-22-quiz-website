<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quiz_answers')->insert([
            'quiz_question_id' => '1',
            'correct' => '0',
            'answer' => 'Edward H. White',
        ]);

        DB::table('quiz_answers')->insert([
            'quiz_question_id' => '1',
            'correct' => '0',
            'answer' => 'Roger B. Chaffee',
        ]);

        DB::table('quiz_answers')->insert([
            'quiz_question_id' => '1',
            'correct' => '0',
            'answer' => 'John W. Young',
        ]);

        DB::table('quiz_answers')->insert([
            'quiz_question_id' => '1',
            'correct' => '1',
            'answer' => 'Virgil I. Grissom',
        ]);
    }
}
