<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Match_question;
use Illuminate\Support\Facades\App;


class Match_question_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'match_question_languages';

    protected $fillable = [
        'audio',//nullable , max:5000
        'header',//nullable
        'language',//required ,limit 2
        'match_question_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function match_question(){
        return $this->belongsTo(Match_question::class,'match_question_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('match_question_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
