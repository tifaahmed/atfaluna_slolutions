<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;
use App\Models\Activity;

class Sub_user_activity extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'sub_user_activities';

    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',//unsigned
        'activity_id',//unsigned
        'points',
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
