<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Government;
use App\Models\City;

class Country extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'countries';
    
    protected $fillable = [
        'name', //required unique
        'image',//required, max:5000
        'code', //required , unique
    ];
    //relation
        public function government(){
            return $this->HasMany(Government::class);
        }
        public function city(){
            return $this->hasManyThrough(City::class, Government::class);
        }

}
