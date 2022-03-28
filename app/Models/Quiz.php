<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Quiz_language;            // HasMany
use App\Models\True_false_question;      // HasMany
use App\Models\Mcq_question;             // HasMany
use App\Models\Quiz_question;             // HasMany

class Quiz extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'quizzes';

    protected $fillable = [
        'points',//required integer

        'quizable_id',//   lesson_id , sub subject_id  , subject_id 
        'quizable_type',// Lesson , Sub_subject , Subject
    ];

    // relations

        // morphTo
            public function quizable(){
                return $this->morphTo(__FUNCTION__, 'quizable_type', 'quizable_id');
            }

        // HasMany
            public function quiz_languages(){
                return $this->HasMany(Quiz_language::class);
            }
            public function quiz_questions(){
                return $this->HasMany(Quiz_question::class);
            }
            // public function mcq_question(){
            //     return $this->HasMany(Mcq_question::class);
            // }
            // public function true_false_question(){
            //     return $this->HasMany(True_false_question::class);
            // }
}

