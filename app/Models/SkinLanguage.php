<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skin;       
use Illuminate\Support\Facades\App;

class SkinLanguage extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'skin_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'skin_id',//unsigned cascade

    ];
    public $timestamps = false;
    //relation
    public function skin(){
        return $this->belongsTo(Skin::class,'skin_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('skin_id', $id);
    }
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
    
}

