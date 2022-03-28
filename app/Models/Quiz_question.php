<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_question extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',//required integer
        'position',//integer

        'questionable_id',//   mcq_questions_id , true_false_question_id
        'questionable_type',// Mcq_question , True_false_question
    ];

    // relations
        public function quizable(){
            return $this->morphTo(__FUNCTION__, 'questionable_type', 'questionable_id');
        }

}
