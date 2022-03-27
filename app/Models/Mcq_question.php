<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz;
use App\Models\Mcq_question_language;
use App\Models\Mcq_answer;

class Mcq_question extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'mcq_questions';

    protected $fillable = [
        'image',//required, max:5000
        'quiz_id',//unsigned
    ];

    // relation
        public function quiz(){
            return $this->belongsTo(Quiz::class,'quiz_id');
        }
        public function mcq_question_languages(){
            return $this->HasMany(Mcq_question_language::class);
        }
        public function mcq_answer(){
            return $this->HasMany(Mcq_answer::class);
        }
}
