<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;
use App\Models\Massage;

class Conversation extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'conversation';

    protected $fillable = [
        'title',//  string , nullable
        'read',//  boolean , defoult 0
        'sub_user_id',//unsigned  
        'type',// enum ,['single','group'] , defoult single

    ];
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }
    // Groupchat
    public function group_chats(){
        return $this->hasMany(Group_chat::class);
    }
    // Massage
    public function massages(){
        return $this->hasMany(Massage::class);
    }
}
// 