<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Match_question;
use App\Models\Match_answer_language;

class Match_answer extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'match_answers';

    protected $fillable = [
        'image',//nullable, max:5000
        'match_answer_id',//nullable 
        'match_question_id',//unsigned 
        'possition' // 'top','bottom'
    ];
    // relations
    public function match_question(){
        return $this->belongsTo(Match_question::class,'match_question_id');
    }

    public function match_answer(){
        return $this->belongsTo(self::class, 'match_answer_id');
    }
    
    //relation
    public function match_answer_languages(){
        return $this->HasMany(Match_answer_language::class);
    }

}

