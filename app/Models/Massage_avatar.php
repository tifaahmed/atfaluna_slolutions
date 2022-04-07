<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Avatar;

class Massage_avatar extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'massage_avatars';

    protected $fillable = [
        'avatar_id',//unsigned 

    ];
    // relations
        public function avatar(){
            return $this->belongsTo(Avatar::class,'avatar_id');
        }
}
// 