<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Massage;// morphOne


class Avatar extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'avatars';

    protected $fillable = [
        'type',// enum ,['girl','boy','both']
    ];
    public function scopeGender($query,$gender){
        if($gender){
            return $query->where('type', $gender);
        }
    }
    //free 
     // morphOne    
            public function massage(){
                return $this->morphOne(Massage::class, 'massagable');
            }
}
