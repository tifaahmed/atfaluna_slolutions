<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Country;
use App\Models\City;


class Government extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'governments';

    protected $fillable = [
        'name', //not_null
        'country_id', //unsigned  
    ];
    //relation
        public function country(){
            return $this->belongsTo(Country::class,'country_id');
        }
    //relation
    public function city(){
        return $this->HasMany(City::class);
    }
}
