<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Government;


class City extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];
    
    protected $table = 'cities';

    protected $fillable = [
        'name',//unique 
        'government_id',//unsigned  
    ];
    //relation
    public function government(){
        return $this->belongsTo(Government::class,'government_id');
    }
    
}
