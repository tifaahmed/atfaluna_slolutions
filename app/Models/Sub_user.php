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
use App\Models\Sub_user_quiz;


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
            return $this->belongsToMany(Accessory::class, 'sub_user_accessories', 'sub_user_id', 'accessory_id');
        }
        public function subUserAvatar(){
            return $this->belongsToMany(Avatar::class, 'sub_user_avatars', 'sub_user_id', 'avatar_id');
        }
        public function subUserCertificate(){
            return $this->belongsToMany(Certificate::class, 'sub_user_certificates', 'sub_user_id', 'certificate_id');
        }

        public function subUserQuiz(){
            return $this->belongsToMany(Quiz::class, 'sub_user_quizzes', 'sub_user_id', 'quiz_id');
        }
        public function subUserQuizModel(){
            return $this->hasMany(Sub_user_quiz::class);
        }


        

        public function subUserLesson(){
            return $this->belongsToMany(Lesson::class, 'sub_user_lessons', 'sub_user_id', 'lesson_id');
        }
        public function playTime(){
            return $this->hasMany(Play_time::class);
        }


        public function subUserAgeGroup(){
            return $this->belongsToMany(Age_group::class, 'sub_user_age_groups', 'sub_user_id', 'age_group_id');
        }
        public function ActiveAgeGroup(){
            if ($this->subUserAgeGroup()) {
                return $this->subUserAgeGroup()->wherePivot('active' ,1);
            }
        }
        public function subUserSubject(){
            return $this->belongsToMany(Subject::class, 'sub_user_subjects', 'sub_user_id', 'subject_id');
        }
        public function ActiveSubject(){
            if ($this->subUserSubject()) {
                return $this->subUserSubject()->wherePivot('active' ,1);
            }
        }
        public function ActiveSubjectsFromActiveAgeGroup(){
            $active_age_group = $this->ActiveAgeGroup()->first();
            $all_active_subjects = $this->ActiveSubject();
            if ($active_age_group && $all_active_subjects) {
                return $all_active_subjects->where('age_group_id',$active_age_group->id);
            }
        }
}
// 