<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use App\Models\Sub_user;
use App\Models\Sub_user_avatar_accessory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Sub_user_accessory extends Pivot
{
    use HasFactory;
    public $guarded = ['id'];
    public $incrementing = true;


    protected $table = 'sub_user_accessories';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'sub_user_id',
        'accessory_id',
    ];
    // relations
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

    

    // public function sub_user_avatar_accessory(){
    //     return $this->HasMany(Sub_user_avatar_accessory::class,'sub_user_accessory_id');
    // }
    // belongsToMany
    public function sub_user_avatar_accessory(){ // which Accessory  bought by SubUser
        return $this->belongsToMany(Sub_user_avatar::class, 'sub_user_avatar_accessories', 'sub_user_accessory_id', 'sub_user_avatar_id')
        ->using(Sub_user_avatar_accessory::class)->withPivot('id');
    }
} 
