<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Sub_user_avatar_accessory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Sub_user_avatar extends Pivot
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_avatars';
    public $timestamps = false;
    public $incrementing = true;


    protected $fillable = [
        'sub_user_id',
        'avatar_id ',
    ];
   
    public function sub_user_avatar_accessory(){ // which Accessory  bought by SubUser
        return $this->belongsToMany(Sub_user_accessory::class, 'sub_user_avatar_accessories', 'sub_user_avatar_id', 'sub_user_accessory_id')
        ->using(Sub_user_avatar_accessory::class)->withPivot('id');
    }
} 
