<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_subject;
use App\Models\Sub_user;

class Sub_user_sub_subject extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_sub_subjects';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',//integer , exist
        'sub_subject_id',//integer , exist
        'points',// integer / default:0
    ];

    
    // relations
        // belongsTo
        public function sub_subject(){
            return $this->belongsTo(Sub_subject::class,'sub_subject_id');
        }
        public function sub_user(){
            return $this->belongsTo(Sub_user::class,'sub_user_id');
        }
}

