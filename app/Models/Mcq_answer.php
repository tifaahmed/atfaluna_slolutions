<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mcq_question;
use App\Models\Mcq_answer_language;

class Mcq_answer extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'mcq_answers';

    protected $fillable = [
        'image',//nullable, max:5000
        'answer',//required
        'mcq_question_id',//unsigned 
    ];
    // relations
    public function mcq_question(){
        return $this->belongsTo(Mcq_question::class,'mcq_question_id');
    }
    //relation
    public function mcq_answer_languages(){
        return $this->HasMany(Mcq_answer_language::class);
    }

}

