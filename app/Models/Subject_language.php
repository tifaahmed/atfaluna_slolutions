<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use Illuminate\Support\Facades\App;


class Subject_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'subject_languages';


    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'subject_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('subject_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
