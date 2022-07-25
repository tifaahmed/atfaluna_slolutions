<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Match_question_language;   //HasMany
use App\Models\Match_answer;              //HasMany
use App\Models\QuestionTag;              //morphToMany // has many tags 
use App\Models\Quiz;              //morphedByMany      // belong to many Quizs 
use App\Models\QuestionAttempt; 

class Match_question extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'match_questions';

    protected $fillable = [
        'degree',//default 0 
    ];
    // relation

        // HasMany
            public function match_question_languages(){
                return $this->HasMany(Match_question_language::class);
            }
            public function match_answer(){
                return $this->HasMany(Match_answer::class);
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
