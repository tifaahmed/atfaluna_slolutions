<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionAttempt;
use App\Models\Sub_user_quiz;

class QuizAttempt extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'quiz_attempts';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_quiz_id',//required integer
        'score',//integer /default 0
        'status' , //string /['closed','open'] / default open
    ];

    public function scopeQuizAttemptOpen($query){
        return $query->where('status','open');
    }
    public function sub_user_quiz(){
        return $this->belongsTo(Sub_user_quiz::class,'sub_user_quiz_id');
    }
    public function question_attempts(){
        return $this->HasMany(QuestionAttempt::class);
    }
}
