<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subject;
use App\Models\Quiz_language;
use App\Models\True_false_question;
use App\Models\Mcq_question;
class Quiz extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'quizzes';

    protected $fillable = [
        'points',//required integer
        'subject_id',//unsigned
    ];

    // relations
        public function subject(){
            return $this->belongsTo(Subject::class,'subject_id');
        }
        public function quiz_languages(){
            return $this->HasMany(Quiz_language::class);
        }
        public function mcq_question(){
            return $this->HasMany(Mcq_question::class);
        }
        public function true_false_question(){
            return $this->HasMany(True_false_question::class);
        }
}

