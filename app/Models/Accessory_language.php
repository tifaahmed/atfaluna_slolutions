<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use Illuminate\Support\Facades\App;

class Accessory_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'accessory_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'accessory_id', //unsigned cascade 
    ];
    public $timestamps = false;
    //relation
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }

    public function scopeRelatedLanguage($query,$id){
        return $query->where('accessory_id', $id);
    }
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
