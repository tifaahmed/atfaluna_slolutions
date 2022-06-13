<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Subject;                 // belongsTo

use App\Models\Sub_subject_language;    // HasMany
use App\Models\Lesson;                  // HasMany
use App\Models\Sub_user_sub_subject;    // HasMany

use App\Models\Notification;

use App\Models\Quiz;                    //morphMany    
use App\Models\Skill;               //morphMany    

class Sub_subject extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = ['id'];   

    protected $table = 'sub_subjects';

    protected $fillable = [
        'subject_id',//required integer unsigned
        'points',//required integer

    ];
    // relations

        // belongsTo
            public function subject(){
                return $this->belongsTo(Subject::class,'subject_id');
            }
        // HasMany
            public function subSubject_languages(){
                return $this->HasMany(Sub_subject_language::class);
            }
            public function lessons(){
                return $this->HasMany(Lesson::class);
            }
            public function sub_user_sub_subject(){
                return $this->HasMany(Sub_user_sub_subject::class);
            }
            
        // morphOne    
            public function quiz(){
                return $this->morphOne(Quiz::class, 'quizable');
            }
        // morphOne
        public function notification(){
            return $this->morphOne(Notification::class, 'notificable');
        }
        //morphToMany
        public function skills(){
            return $this->morphToMany(Skill::class, 'skillable');
        }
}
