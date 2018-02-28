<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_quizzes', 'quiz_id', 'user_id');
    }
}
