<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Age_group;
use App\Models\Sub_user;

class Sub_user_age_group extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_age_groups';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'age_group_id ',
        'active ',
        'points ',
    ];
    // relations
    public function age_group(){
        return $this->belongsTo(Age_group::class,'age_group_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

} 
