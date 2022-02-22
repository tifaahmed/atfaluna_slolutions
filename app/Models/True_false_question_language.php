<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\True_false_question;
use App\Scopes\AncientScope;


class True_false_question_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'true_false_question_languages';

    protected $fillable = [
        'title',//required
        'language',//required ,limit 2
        'true_false_questions_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function true_false_question(){
        return $this->belongsTo(True_false_question::class,'true_false_questions_id');
    }
    public function scopeRelatedLanguage($query,$id){
        
        return $query->where('true_false_questions_id', $id);
    }
    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
