<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Sub_user;
use App\Models\Activity;

class Sub_user_activity extends Pivot
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'sub_user_activities';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',  // integer , unsigned
        'activity_id',  // integer , unsigned
        'points',       // integer , default 0 
        'game_data'     // longText, json
    ];
    // relations
    public function activity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
