<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExam extends Model
{
    use HasFactory;
    protected $table = 'candidate_exams';

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
