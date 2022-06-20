<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Avatar;       
use App\Models\SkinLanguage;       

class Skin extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'skins';

    protected $fillable = [
        'image',//required, max:5000
        'price',//unsignedDecimal
        'original',
        'avatar_id',

    ];
    //relation
    public function skin_languages(){
        return $this->HasMany(SkinLanguage::class);
    }
    // belongsTo
    public function avatar(){
        return $this->belongsTo(Avatar::class,'avatar_id');
    } 
    public function scopeFree($query){
        return $query->where('price','<=',0);
    }
    public function scopeHasPrice($query){
        return $query->where('price','>',0);
    }
}

