<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Accessory;


class Sub_user extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'sub_users';


    protected $fillable = [
        'name',//required , string
        'age',//required , integer
        'gender',// enum ,['girl','boy']
        'points',// integer
        'user_id',//unsigned  
    ];
    // relations
        public function user(){
            return $this->belongsTo(User::class,'user_id');
        }
        public function subUserAccessory(){
            return $this->belongsToMany(Accessory::class, 'sub_user_accessories', 'sub_users_id', 'accessory_id');
        }
}
