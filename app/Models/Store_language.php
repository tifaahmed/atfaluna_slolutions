<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;


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
}
