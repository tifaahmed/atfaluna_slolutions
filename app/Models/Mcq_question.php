<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Mcq_question_language;   //HasMany
use App\Models\Mcq_answer;              //HasMany
use App\Models\QuestionTag;              //morphedByMany

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
    // relation

        // HasMany
            public function mcq_question_languages(){
                return $this->HasMany(Mcq_question_language::class);
            }
            public function mcq_answer(){
                return $this->HasMany(Mcq_answer::class);
            }

        // morphedByMany    
            public function question_tags(){
                return $this->morphToMany(QuestionTag::class, 'question_tagables');
            }   
              
}
