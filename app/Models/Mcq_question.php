<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Mcq_question_language;   //HasMany
use App\Models\Mcq_answer;              //HasMany
use App\Models\QuestionTag;              //morphToMany // has many tags 
use App\Models\Quiz;              //morphedByMany      // belong to many Quizs 
use App\Models\Quiz_questionable; 
use App\Models\QuestionAttempt; 

class Mcq_question extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'mcq_questions';

    protected $fillable = [
        'image',//required, max:5000
        'degree',//default 0 
        'level',//'hard','medium','easy'  default easy
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            Quiz_questionable::
            where('questionable_id',$model->id )->
            where('questionable_type',Mcq_question::class)->
            delete();
            QuestionAttempt::
            where('questionable_id',$model->id )->
            where('questionable_type',Mcq_question::class)->
            delete();
        });
    }

    // relation

        // HasMany
            public function mcq_question_languages(){
                return $this->HasMany(Mcq_question_language::class);
            }
            public function mcq_answer(){
                return $this->HasMany(Mcq_answer::class);
            }
        // morphToMany    
            public function question_tags(){
                return $this->morphToMany(QuestionTag::class, 'question_tagables');
            }  

        // morphedByMany    
            public function Quizs(){
                return $this->morphToMany(Quiz::class, 'quiz_questionables');
            } 
            public function question_attempts(){
                return $this->morphOne(QuestionAttempt::class, 'question_attempts','questionable_type','questionable_id');
            }  
}
