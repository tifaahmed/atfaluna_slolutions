<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use Illuminate\Support\Facades\App;


class Lesson_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'lesson_languages';


    protected $fillable = [
        'image',//required, max:5000
        'name',//required
        'language',//required ,limit 2
        'lesson_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('lesson_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
