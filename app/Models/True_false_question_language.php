<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\True_false_question;


class True_false_question_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'true_false_question_languages';

    protected $fillable = [
        'title',//required
        'language',//required ,limit 2
        'true_false_questions_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function true_false_question(){
        return $this->belongsTo(True_false_question::class,'true_false_questions_id');
    }

}
