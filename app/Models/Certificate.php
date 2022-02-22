<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sub_user;
use App\Models\Subject;
use App\Models\Certificate_language
;


class Certificate extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'certificates';

    protected $fillable = [
        'relation_id',// cascade
        'relation_type',// cascade
        'image_one',//required
        'image_two',//required
        'min_point',//required integer
        'max_point',//required integer
        'subject_id',//unsigned
        'sub_users_id',//unsigned
    ];
    // relations
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_users_id');
    }
    //relation
    public function certificate_languages(){
    return $this->HasMany(Certificate_language::class);
    }
}


