<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SkinLanguage;      // HasMany

use App\Models\Avatar;            // belongsTo

use App\Models\Accessory;         // belongsToMany

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
    // scope
        public function scopeOriginal($query){
            return $query->where('original',1);
        }

    //relation

        // HasMany
        public function skin_languages(){
            return $this->HasMany(SkinLanguage::class);
        }

        // belongsTo
        public function avatar(){
            return $this->belongsTo(Avatar::class,'avatar_id');
        } 


        // belongsToMany
        public function accessorySkins(){
            return $this->belongsToMany(Accessory::class, 'accessory_skins', 'skin_id', 'accessory_id');
        }


}

