<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_questionable extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'quiz_questionables';

    protected $fillable = [
        'quiz_id',//required , integer , unsigned
        'position',//integer , default 0

        'questionable_id',// integer , required , exist / ex: mcq_questions_id , true_false_question_id
        'questionable_type',// string , required /ex: Mcq_question , True_false_question
    ];
    protected static function boot()
    {
        parent::boot();
        Quiz_questionable::creating(function ($model) {
            $model->position = Quiz_questionable::max('position') + 1;
        });
    }
        // morphTo
        public function morph_to(){
            return $this->morphTo('questionable');
        }

}
