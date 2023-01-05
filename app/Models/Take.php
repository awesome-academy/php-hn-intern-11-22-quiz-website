<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Take extends Model
{
    use HasFactory;

    const STATUS_DONE = 1;
    const INITIAL_SCORE = 0;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function takeAnswers()
    {
        return $this->hasMany(TakeAnswer::class);
    }
}
