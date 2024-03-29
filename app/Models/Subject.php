<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Age_group;        //belongsTo

use App\Models\Subject_language; //HasMany
use App\Models\Sub_subject;      //HasMany

use App\Models\Lesson;           //hasManyThrough
use App\Models\Notification;

use App\Models\Certificate;      //morphOne
use App\Models\Quiz;             //morphMany    
use App\Models\Skillable;        //morphMany

use App\Models\Sub_user;         //belongsToMany

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'subjects';

    protected $fillable = [
        'image',//required , max:5000
        'points',//required integer
        'age_group_id',//unsigned
    ];

    // relations


        //belongsToMany
            public function subUserSubject(){
                return $this->belongsToMany(Sub_user::class, 'sub_user_subjects', 'subject_id', 'sub_user_id')->withPivot(['active','points']);
            }
            

        // belongsTo
            public function age_group(){
                return $this->belongsTo(Age_group::class,'age_group_id');
            }

        // HasMany
            public function sub_subjects(){
                return $this->HasMany(Sub_subject::class);
            }
            public function subject_languages(){
                return $this->HasMany(Subject_language::class);
            }

        // hasManyThrough
            public function lessons(){
                return $this->hasManyThrough(Lesson::class, Sub_subject::class);
            }

        // morphOne    
            public function certificate(){
                return $this->morphOne(Certificate::class, 'certificatable');
            } 
            public function quiz(){
                return $this->morphOne(Quiz::class, 'quizable');
            }
        // morphOne
            public function notification(){
                return $this->morphOne(Notification::class, 'notificable');
            }
            public function skills(){
                return $this->morphToMany(Skill::class, 'skillable');
            }
        

}
