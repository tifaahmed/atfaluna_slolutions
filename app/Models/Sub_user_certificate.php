<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;
use App\Models\Certificate;

class Sub_user_certificate extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_certificates';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'certificate_id',
        'point',

    ];
    // relations
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificate_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
