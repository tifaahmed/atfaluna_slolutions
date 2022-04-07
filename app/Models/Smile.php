<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Avatar;
use App\Models\Hero;

class Smile extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'smiles';

    protected $fillable = [
        'avatar_id',//unsigned  
        'hero_id',//unsigned  
    ];
    // relations
    public function avatar(){
        return $this->belongsTo(Avatar::class,'avatar_id');
    }
    public function hero(){
        return $this->belongsTo(Hero::class,'hero_id');
    }
}
// 