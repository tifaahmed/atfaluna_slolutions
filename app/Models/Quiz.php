<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Quiz_language;            // HasMany
use App\Models\Quiz_questionable;        // HasMany
use App\Models\Sub_user_quiz;            // HasMany

use App\Models\Quiz_type;             // OneToMany
use App\Models\Notification;

use App\Models\True_false_question;      // morphedByMany
use App\Models\Mcq_question;             // morphedByMany

class Quiz extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'quizzes';

    protected $fillable = [
        'points',// integer / default 0
        'minimum_requirements', // integer / default 0
        'quizable_id',//   required , integer , exists / ex  lesson_id , sub subject_id  , subject_id 
        'quizable_type',// required / ex Lesson , Sub_subject , Subject
    ];

    // relations

        // morphTo
            public function quizable(){
                return $this->morphTo('quizable');
            }
        // morphOne
        public function notification(){
            return $this->morphOne(Notification::class, 'notificable');
        }
        // HasMany
            public function quiz_languages(){
                return $this->HasMany(Quiz_language::class);
            }
            public function quiz_questionable(){
                return $this->HasMany(Quiz_questionable::class,'quiz_id');
            }
            public function sub_user_quizzes(){
                return $this->HasMany(Sub_user_quiz::class);
            }
        // morphedByMany    
            public function mcq_questions(){
                return $this->morphedByMany(Mcq_question::class,'questionable','quiz_questionables');
            }
            public function true_false_questions(){
                return $this->morphedByMany(True_false_question::class,'questionable','quiz_questionables');
            }



}

