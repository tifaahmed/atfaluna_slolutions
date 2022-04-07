<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hero;

class Massage_hero extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'massage_heroes';

    protected $fillable = [
        'hero_id',//unsigned 

    ];
    // relations
        public function hero(){
            return $this->belongsTo(Hero::class,'hero_id');
        }
}
// 