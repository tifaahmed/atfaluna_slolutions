<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subject;
use App\Models\Quiz_language;
use App\Models\True_false_question;
use App\Models\Mcq_question;
class Quiz extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'quizzes';

    protected $fillable = [
        'points',//required integer
        'subject_id',//unsigned
    ];
    // relations
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    // relations
    public function quiz_languages(){
    return $this->HasMany(Quiz_language::class);
    }
    // public function quizMcqQuestion(){
    //     return $this->belongsToMany(Mcq_question::class, 'quiz_mcq_questions', 'quizs_id', 'mcq_question_id');
    // }
    // public function quizTrueOrFalseQuestion(){
    //     return $this->belongsToMany(True_false_question::class, 'quiz_true_false_questions', 'quizs_id', 'true_false_question_id');
    // }
}

