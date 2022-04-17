<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Sub_user;
use App\Models\QuizAttempt;

class Sub_user_quiz extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_quizzes';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',//integer , exist
        'quiz_id',//integer , exist
        'score',// integer / default:0
        'pass', // boolean / default:0
    ];
    // relations
        // belongsTo
        public function quiz(){
            return $this->belongsTo(Quiz::class,'quiz_id');
        }
        public function sub_user(){
            return $this->belongsTo(Sub_user::class,'sub_user_id');
        }
        // hasMany
        public function quiz_attempts(){
            return $this->hasMany(QuizAttempt::class);
        }

}

