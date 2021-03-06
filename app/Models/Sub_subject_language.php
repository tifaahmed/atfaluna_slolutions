<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Sub_subject;

class Sub_subject_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];   

    protected $table = 'sub_subject_languages';

    protected $fillable = [
        'image_one',//  max:5000
        'image_two',//  max:5000
        'name',// 
        'description',// 
        'language',//required
        'sub_subject_id',//required integer unsigned
    ];
    public $timestamps = false;

    // relations
        public function sub_subject(){
            return $this->belongsTo(Sub_subject::class,'sub_subject_id');
        }
        public function scopeRelatedLanguage($query,$id){
            return $query->where('sub_subject_id', $id);
        }

        public function scopeLocalization($query){
            return $query->where('language', App::getLocale());
        }
    // morph
    public function sound(){
        return $this->morphToMany(Sound::class, 'soundable','soundables');
    }
}