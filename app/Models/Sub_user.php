<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Accessory;
use App\Models\Avatar;
use App\Models\Certificate;


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
        'avatar_id',//unsigned  

    ];
    // relations
        public function user(){
            return $this->belongsTo(User::class,'user_id');
        }
        public function avatar(){
            return $this->belongsTo(Avatar::class,'avatar_id');
        }
        public function subUserAccessory(){
            return $this->belongsToMany(Accessory::class, 'sub_user_accessories', 'sub_users_id', 'accessory_id');
        }
        public function subUserAvatar(){
            return $this->belongsToMany(Avatar::class, 'sub_user_avatars', 'sub_users_id', 'avatar_id');
        }
        public function subUserCertificate(){
            return $this->belongsToMany(Certificate::class, 'sub_user_certificates', 'sub_users_id', 'certificate_id');
        }
}
