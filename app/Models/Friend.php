<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;

class Friend extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'friends';

    protected $fillable = [
        'online',//required , boolean
        'accept',//required , boolean
        'block',//required , boolean
        'sub_user_id',//unsigned  
        'recevier_id',//unsigned  

    ];
    // relations
        public function sub_user(){
            return $this->belongsTo(Sub_user::class,'sub_user_id');
        }
}
// 