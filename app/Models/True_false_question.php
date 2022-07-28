<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz;
use App\Models\True_false_question_language;
use App\Models\QuestionTag;


class True_false_question extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'true_false_questions';

    protected $fillable = [
        'image', // string   / nullable , max:5000
        'degree',// integer  / default:0
        'level', // enum     / 'hard','medium','easy' default:easy
        'answer',// boolean  / default:0
    ];
    //relation
        // HasMany
            public function true_false_question_languages(){
                return $this->HasMany(True_false_question_language::class);
            }

        // morphedByMany    
            public function question_tags(){
                return $this->morphToMany(QuestionTag::class, 'question_tagables');
            }   
}
