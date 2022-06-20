<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use Illuminate\Support\Facades\App;

class Skill_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'skill_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'description',
        'skill_id',//unsigned cascade
        'image_one',// required , max:5000
        'image_two',// required , max:5000

    ];
    public $timestamps = false;
    //relation
    public function skill(){
        return $this->belongsTo(Skill::class,'skill_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('skill_id', $id);
    }
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
