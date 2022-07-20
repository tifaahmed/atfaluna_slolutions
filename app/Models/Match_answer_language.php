<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Match_answer;
use Illuminate\Support\Facades\App;


class Match_answer_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'match_answer_languages';

    protected $fillable = [
        'title',//required
        'audio',//nullable , max:5000
        'language',//required ,limit 2
        'match_answer_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function match_answer(){
        return $this->belongsTo(Match_answer::class,'match_answer_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('match_answer_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
