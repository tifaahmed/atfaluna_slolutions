<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use Illuminate\Support\Facades\App;

class Activity_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'activity_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'image_one',//nullable , max:5000
        'image_two',//nullable , max:5000
        'url',//nullable , max:5000
        'activity_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function activity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('activity_id', $id);
    }
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }

}
