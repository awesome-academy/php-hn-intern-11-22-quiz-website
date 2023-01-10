<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    const MIN_ANSWER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'correct',
        'answer',
        'quiz_question_id',
    ];

    public function quizQuestion()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
