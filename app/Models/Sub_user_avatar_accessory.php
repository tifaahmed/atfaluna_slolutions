<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sub_user_avatar;
use App\Models\Sub_user_accessory;
use Illuminate\Database\Eloquent\Relations\Pivot;


class Sub_user_avatar_accessory extends Pivot
{
    use HasFactory;

    public $guarded = ['id'];
    public $incrementing = true;


    protected $table = 'sub_user_avatar_accessories';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_avatar_id',// unsigned 
        'sub_user_accessory_id',//  unsigned 
        // 'active',//  boolean  / default 0 
    ];

    public function sub_user_avatar(){
        return $this->belongsTo(Sub_user_avatar::class,'sub_user_avatar_id');
    }
    public function sub_user_accessory(){
        return $this->belongsTo(Sub_user_accessory::class,'sub_user_accessory_id');
    }

}
