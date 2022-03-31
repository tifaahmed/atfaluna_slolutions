<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Accessory;
use App\Models\Avatar;
use App\Models\Certificate;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Age_group;


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
        public function subUserQuiz(){
            return $this->belongsToMany(Quiz::class, 'sub_user_quizzes', 'sub_users_id', 'quiz_id');
        }
        public function subUserLesson(){
            return $this->belongsToMany(Lesson::class, 'sub_user_lessons', 'sub_users_id', 'lesson_id');
        }
        public function subUserSubject(){
            return $this->belongsToMany(Subject::class, 'sub_user_subjects', 'sub_users_id', 'subject_id');
        }
        public function subUserAgeGroup(){
            return $this->belongsToMany(Age_group::class, 'sub_user_age_groups', 'sub_users_id', 'age_group_id');
        }
        public function subUserActiveAgeGroup(){
            return $this->belongsToMany(Age_group::class, 'sub_user_age_groups', 'sub_users_id', 'age_group_id')->wherePivot('active' , 1);
        }
        public function playTime(){
            return $this->hasMany(Play_time::class);
        }
}
// 