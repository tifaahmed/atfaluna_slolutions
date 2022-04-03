<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use Illuminate\Support\Facades\App;


class Quiz_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'quiz_languages';

    protected $fillable = [
        'name',     //required , max:255
        'language', //required ,max:2
        'image_one',//required, max:5000
        'image_two',//required, max:5000
        'quiz_id',  //unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('quiz_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
