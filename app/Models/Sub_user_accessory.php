<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use App\Models\Sub_user;

class Sub_user_accessory extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_accessories';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'accessory_id',
    ];
    // relations
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

} 
