<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use Illuminate\Support\Facades\App;


class Store_language extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'store_languages';
    
    protected $fillable = [
        'name',//required
        'language',//required
        'store_id',//required unsigned cascade 
    ];

    public $timestamps = false;
    // relations
        public function store(){
            return $this->belongsTo(Store::class,'store_id');
        }
    // relations
    public function scopeRelatedLanguage($query,$id){
            return $query->where('store_id', $id);
        }

        public function scopeLocalization($query){
            return $query->where('language', App::getLocale());
        }
}
