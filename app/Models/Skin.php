<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

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
        public function scopeNotOriginal($query){
            return $query->where('original',0);
        }
        public function scopeActiveSkin($query,$sub_user_id){
            
            $accessory_ids = Accessory::whereHas('SubUserAccessory', function (Builder $sub_user_accessory_query) use($sub_user_id) {
                $sub_user_accessory_query->where('sub_user_id',$sub_user_id);
                $sub_user_accessory_query->where('active',1);
            })->pluck('id')->toArray();

            // git sub_user active skin
            foreach ($accessory_ids as $key => $value) {
                $query = $query->whereHas('accessorySkins', function (Builder $accessory_query) use($value) {
                    $accessory_query->where('accessory_id',$value);
                });
            }
            return $query;

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

