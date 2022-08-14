<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Lesson_type;      // belongsTo
use App\Models\Sub_subject;      // belongsTo

use App\Models\Hero;             //belongsToMany
use App\Models\Sub_user;         // belongsToMany
use App\Models\Accessory;         // belongsToMany

use App\Models\Lesson_language;  // HasMany
use App\Models\Activity;         //HasMany    

use App\Models\Quiz;             //morphMany    
use App\Models\Skill;            //morphMany    

use App\Models\Notification;

class Lesson extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'lessons';

    protected $fillable = [
        'points',//required integer default(0)
        'sub_subject_id',//unsigned
        'lesson_type_id',//unsigned
    ];
    // relations

        // belongsTo
            public function subSubject(){
                return $this->belongsTo(Sub_subject::class,'sub_subject_id');
            }
            public function lesson_type(){
                return $this->belongsTo(Lesson_type::class,'lesson_type_id');
            }
            
        // belongsToMany
            public function herolesson(){
                return $this->belongsToMany(Hero::class, 'hero_lessons', 'lesson_id','hero_id' );
            }
            public function AccessoryLesson(){
                return $this->belongsToMany(Accessory::class, 'accessory_lessons', 'lesson_id', 'accessory_id');
            }

        // HasMany
            public function lesson_languages(){
                return $this->HasMany(Lesson_language::class);
            }
            public function activities(){
                return $this->HasMany(Activity::class);
            }
            public function subUserLesson(){
                return $this->belongsToMany(Sub_user::class, 'sub_user_lessons', 'lesson_id', 'sub_user_id')->withPivot(['points','game_data']);
            }

        // morphMany    
            public function quiz(){
                return $this->morphMany(Quiz::class, 'quizable'); // assignment
            }
        //morphToMany
            public function skills(){
                return $this->morphToMany(Skill::class, 'skillable');
            }
        // morphOne
            public function notification(){
                return $this->morphOne(Notification::class, 'notificable');
            }
}


