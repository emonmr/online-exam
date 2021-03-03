<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    public function firstQuestion()
    {
        return $this->belongsToMany(Question::class)->orderBy('id' , 'asc')->take(1);
    }

}
