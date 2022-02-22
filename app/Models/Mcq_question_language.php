<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mcq_question;


class Mcq_question_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'mcq_question_languages';

    protected $fillable = [
        'title',//required
        'language',//required ,limit 2
        'mcq_questions_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function mcq_question(){
        return $this->belongsTo(Mcq_question::class,'mcq_questions_id');
    }

}
