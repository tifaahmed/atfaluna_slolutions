<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use App\Scopes\AncientScope;


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
    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
