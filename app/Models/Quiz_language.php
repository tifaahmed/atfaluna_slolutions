<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Scopes\AncientScope;


class Quiz_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'quiz_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'quiz_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function scopeRelatedLanguage($query,$id){
        
        return $query->where('quiz_id', $id);
    }
    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
