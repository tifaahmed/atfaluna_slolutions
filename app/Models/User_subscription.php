<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class User_subscription extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'user_subscriptions';


    protected $fillable = [
        'start',//required ,integer
        'end',//required ,integer
        'child_number',//required ,integer,limit 2
        'user_id',//unsigned
    ];
    // relations
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

