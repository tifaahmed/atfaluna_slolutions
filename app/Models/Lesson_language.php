<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Scopes\AncientScope;


class Lesson_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'lesson_languages';


    protected $fillable = [
        'item',//required
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
    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
