<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Achievement;
use Illuminate\Support\Facades\App;

class Achievement_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'achievement_languages';

    protected $fillable = [
        'name',//required
        'description',//nullable
        'language',//required ,limit 2
        'achievement_id', //unsigned cascade 
    ];
    public $timestamps = false;
    //relation
    public function achievement(){
        return $this->belongsTo(Achievement::class,'achievement_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('achievement_id', $id);
    }
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
