<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Sub_user;

class Sub_user_subject extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_quizzes';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',//integer , exist
        'subject_id',//integer , exist
        'points',// integer / default:0
        'active', // boolean / default:0
    ];
    // relations
        // belongsTo
        public function subject(){
            return $this->belongsTo(Subject::class,'subject_id');
        }
        public function sub_user(){
            return $this->belongsTo(Sub_user::class,'sub_user_id');
        }
}

