<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\Sub_user;

class Sub_user_lesson extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_lessons';
    public $timestamps = false;

    protected $fillable = [
        'sub_users_id',
        'lesson_id',
        'score',
    ];
    // relations
    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_users_id');
    }

}
