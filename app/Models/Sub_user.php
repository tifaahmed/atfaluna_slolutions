<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Accessory;
use App\Models\Package;
use App\Models\Avatar;
use App\Models\Certificate;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Age_group;
use App\Models\Sub_user_quiz;
use App\Models\Sub_user_certificate;
use App\Models\Group_chat;
use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Activity;
use App\Models\Sub_user_subscription;
use App\Models\Sub_user_lesson;
use App\Models\Sub_user_sub_subject;
use App\Models\Sub_user_subject;
use App\Models\Duration_time;


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
    //Accessory
        public function subUserAccessory(){
            return $this->belongsToMany(Accessory::class, 'sub_user_accessories', 'sub_user_id', 'accessory_id');
        }
    //Avatar
        public function subUserAvatar(){
            return $this->belongsToMany(Avatar::class, 'sub_user_avatars', 'sub_user_id', 'avatar_id')->withPivot('active');
        }
        public function subUserActiveAvatar(){
            return $this->subUserAvatar()->wherePivot('active',1);
        }
    //Activity
        public function subUserActivity(){
            return $this->belongsToMany(Activity::class, 'sub_user_activities', 'sub_user_id', 'activity_id');
        }
    //Lesson

        public function subUserLesson(){
            return $this->belongsToMany(Lesson::class, 'sub_user_lessons', 'sub_user_id', 'lesson_id');
        }
        public function subUserLessonModel(){
            return $this->hasMany(Sub_user_lesson::class);
        }

        public function playTime(){
            return $this->hasMany(Play_time::class);
        }
    //Certificate
        public function subUserCertificate(){
            return $this->belongsToMany(Certificate::class, 'sub_user_certificates', 'sub_user_id', 'certificate_id');
        }
    //Quiz
        public function subUserQuiz(){
            return $this->belongsToMany(Quiz::class, 'sub_user_quizzes', 'sub_user_id', 'quiz_id');
        }
        public function subUserQuizModel(){
            return $this->hasMany(Sub_user_quiz::class);
        }
        //Age_group
        public function subUserAgeGroup(){
            return $this->belongsToMany(Age_group::class, 'sub_user_age_groups', 'sub_user_id', 'age_group_id');
        }
        public function subUserAgeGroupModel(){
            return $this->hasMany(Sub_user_age_group::class);
        }
        public function ActiveAgeGroup(){
            if ($this->subUserAgeGroup()) {
                return $this->subUserAgeGroup()->wherePivot('active' ,1);
            }
        }
        //Subject
        public function subUserSubject(){
            return $this->belongsToMany(Subject::class, 'sub_user_subjects', 'sub_user_id', 'subject_id');
        }
        public function subUserSubjectModel(){
            return $this->hasMany(Sub_user_subject::class);
        }
        //sub_Subject
        public function subUserSubSubject(){
            return $this->belongsToMany(Sub_subject::class, 'sub_user_sub_subjects', 'sub_user_id', 'sub_subject_id');
        }
        public function subUserSubSubjectModel(){
            return $this->hasMany(Sub_user_sub_subject::class);
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
        public function subUserCertificateModel(){
            return $this->hasMany(Sub_user_certificate::class);
        }
        // Groupchat
        public function group_chat(){
            return $this->hasMany(Group_chat::class);
        }
        // Massage
        public function massages(){
            return $this->hasMany(Massage::class);
        }
        // Conversation
        public function conversation(){
            return $this->hasMany(Conversation::class);
        }
        // Friend
        public function friend(){
            return $this->hasMany(Friend::class);
        } 

        public function SubUserSubscriptions(){
            return $this->hasMany(Sub_user_subscription::class);
        }
        public function durationTime(){
            return $this->hasMany(Duration_time::class);
        }
        
}
// 