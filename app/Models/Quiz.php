<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Quiz_language;            // HasMany
// use App\Models\Quiz_questionable;             // HasMany

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
    protected static function boot()
    {
        parent::boot();

        // Quiz::creating(function ($model) {
        //     if ($model->quizable_type == 'sub_subject') {
        //         $model_name = 'App\Models\Sub_subject';
        //     }else if ($model->quizable_type == 'subject'){
        //         $model_name = 'App\Models\Subject';
        //     }else if ($model->quizable_type == 'lesson'){
        //         $model_name = 'App\Models\Lesson';
        //     }
        //     $model->quizable_type = $model_name;
        // });
        // Quiz::updating(function ($model) {
        //     if ($model->quizable_type == 'sub_subject') {
        //         $model_name = 'App\Models\Sub_subject';
        //     }else if ($model->quizable_type == 'subject'){
        //         $model_name = 'App\Models\Subject';
        //     }else if ($model->quizable_type == 'lesson'){
        //         $model_name = 'App\Models\Lesson';
        //     }
        //     $model->quizable_type = $model_name;
        // });
    }
    // relations

        // morphTo
            public function quizable(){
                return $this->morphTo();
            }

        // HasMany
            public function quiz_languages(){
                return $this->HasMany(Quiz_language::class);
            }
        // morphedByMany    
            public function mcq_questions(){
                return $this->morphedByMany(Mcq_question::class,'quiz_questionable','quiz_questionables');
            }
            public function true_false_questions(){
                return $this->morphedByMany(True_false_question::class,'quiz_questionable','quiz_questionables');
            }



}

