<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Sub_user;

class Sub_user_quiz extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_quizzes';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',//unsigned
        'quiz_id',//unsigned
        'score',//required integer
    ];
    // relations
    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}

