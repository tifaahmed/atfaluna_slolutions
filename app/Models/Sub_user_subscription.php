<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sub_user;

class Sub_user_subscription extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'sub_user_subscriptions';


    protected $fillable = [
        
        'start',//required ,integer
        'end',//required ,integer
        'sub_user_id',//unsigned
        'price',//required ,decimal
    ];

    // relations
    public function subUser(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}

