<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mcq_answer;
use Illuminate\Support\Facades\App;


class Mcq_answer_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'mcq_answer_languages';

    protected $fillable = [
        'title',//required
        'language',//required ,limit 2
        'mcq_answers_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function mcq_answer(){
        return $this->belongsTo(Mcq_answer::class,'mcq_answers_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('mcq_answers_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
