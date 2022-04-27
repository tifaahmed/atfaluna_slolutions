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
        'type',// enum ,['girl','boy']
        'image',//required, max:5000
        'price',//unsignedDecimal
    ];
    public function scopeFree($query){
        return $query->where('price','<=',0);
    }
    public function scopeHasPrice($query){
        return $query->where('price','>',0);
    }
    public function scopeGender($query,$gender){
        if($gender){
            return $query->where('type', $gender);
        }
    }
    public function subUserAvatar(){
        return $this->belongsToMany(Sub_user::class, 'sub_user_avatars', 'avatar_id', 'sub_user_id');
    }
    //free 
     // morphOne    
            public function massage(){
                return $this->morphOne(Massage::class, 'massagable');
            }


}
