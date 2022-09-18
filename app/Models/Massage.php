<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\Sub_user;

class Massage extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'massages';

    protected $fillable = [
        'massagable_id',//  ,morphs_id (avatar_id , hero_id ,massage_image_id)']
        'massagable_type',// morphs_type (avatar_model , hero_model , massage_image_model)
        'text',//required not null
        'sub_user_id',//unsigned 
        'conversation_id',//unsigned  
    ];
    // relations
    public function conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id');
    }
        
    public function subUserMessageRead(){
        return $this->belongsToMany(Sub_user::class, 'sub_user_messages', 'massage_id', 'sub_user_id')->withPivot('read');
    }

    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }
    public function massagable()
    {
        return $this->morphTo(__FUNCTION__, 'massagable_type', 'massagable_id');
    }
}
//required