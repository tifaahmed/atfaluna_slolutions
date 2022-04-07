<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\Sub_user;
use App\Models\Massage_image;

class Massage extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'massages';

    protected $fillable = [
        'massagable_id',//  ,morphs_id (avatar_id , hero_id ,massage_image_id)']
        'massagable_type',// morphs_type (avatar_model , hero_model , massage_image_model)
        'recevier_id',//required , integer
        'text',//required not null

        'sub_user_id',//unsigned 
        'conversation_id',//unsigned  
        'massage_image_id',//unsigned 
    ];
    // relations
    public function conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id');
    }public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }public function massage_image(){
        return $this->belongsTo(Massage_image::class,'massage_image_id');
    }
    public function massagable()
    {
        return $this->morphTo(__FUNCTION__, 'massagable_type', 'massagable_id');
    }
