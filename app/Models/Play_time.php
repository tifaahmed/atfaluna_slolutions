<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sub_user;


class Play_time extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'play_times';

    protected $fillable = [
        'day',// enum ,[1,2,3,4,5,6,7]
        'status',// boolean default:1
        'start',//required , time
        'end',//required , time
        'sub_user_id',//unsigned
    ];
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
