<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\True_false_question;
use Illuminate\Support\Facades\App;


class True_false_question_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'true_false_question_languages';

    protected $fillable = [
        'video',//nullable, max:5000

        'audio',//nullable , max:5000
        'title',//required

        'header',//nullable 

        'language',//required ,limit 2
        'true_false_question_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function true_false_question(){
        return $this->belongsTo(True_false_question::class,'true_false_question_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('true_false_question_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
