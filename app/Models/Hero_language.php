<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hero;
use Illuminate\Support\Facades\App;

class Hero_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'hero_languages';

    protected $fillable = [
        'image',//required, max:5000
        'title',//required
        'description',//required
        'language',//required ,limit 2
        'hero_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function hero(){
        return $this->belongsTo(Hero::class,'hero_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('hero_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
