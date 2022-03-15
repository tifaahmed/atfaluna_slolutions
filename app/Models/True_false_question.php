<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz;
use App\Models\True_false_question_language;


class True_false_question extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'true_false_questions';

    protected $fillable = [
        'image',//required , max:5000
        'videos',//required , max:5000
        'audio',//required , max:5000
        'answer',//boolean [default:false]

        'quiz_id',//unsigned 
    ];
    //relation
    public function quiz(){
    return $this->belongsTo(Quiz::class,'quiz_id');
    }
    // relations
    public function true_false_question_languages(){
    return $this->HasMany(True_false_question_language::class);
    }
}
