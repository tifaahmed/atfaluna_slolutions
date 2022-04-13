<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizAttempt;

class QuestionAttempt extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'question_attempts';
    public $timestamps = false;

    protected $fillable = [
        'quiz_attempt_id',//required integer
        'status' , //string /['closed','open'] / default open
        'answer',//boolean /default 0

        'questionable_id', //[note: 'morphs_id (mcq_questions_id , true_false_question_id)']
        'questionable_type',//[note: 'morphs_type (Mcq_question , True_false_question)']
    ];
    public function scopeQuestionAttemptOpen($query){
        return $query->where('status','open');
    }
    public function quiz_attempt (){
        return $this->belongsTo(QuizAttempt::class);
    }

    public function questionable(){
        return $this->morphTo();
    }

}
