<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Achievement;
use App\Models\Sub_user;

class Sub_user_achievement extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_achievements';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'achievement_id',
    ];
    // relations
    public function achievement(){
        return $this->belongsTo(Achievement::class,'achievement_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

} 
