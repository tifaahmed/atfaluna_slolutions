<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skin;
use App\Models\Sub_user;

class SubUserSkin extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_skins';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'skin_id',
        'active',
    ];
    // relations
    public function Skin(){
        return $this->belongsTo(Skin::class,'skin_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
