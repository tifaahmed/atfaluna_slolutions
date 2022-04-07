<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;

class Group_chat extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'group_chats';

    protected $fillable = [
        'recevier_id',//required , integer
        'conversation_id',//unsigned  
    ];
    // relations
        public function conversation(){
            return $this->belongsTo(Conversation::class,'conversation_id');
        }
}
// 