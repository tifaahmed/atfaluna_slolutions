<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTagable extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'question_tagables';

    protected $fillable = [
        'question_tag_id',// integer ,required , unsigned , 
        'position',//integer  , default 0 
        'question_tagable_id',// integer ,required , exists //   ex: mcq_questions_id , true_false_question_id
        'question_tagable_type',// string , required  // ex: Mcq_question , True_false_question
    ];
    protected static function boot()
    {
        parent::boot();

        QuestionTagable::creating(function ($model) {
            $model->position = QuestionTagable::max('position') + 1;
        });
    }

}
