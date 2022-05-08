<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Lesson_type;      // belongsTo
use App\Models\Sub_subject;      // belongsTo
use App\Models\Hero;             //belongsToMany

use App\Models\Lesson_language;  // HasMany

use App\Models\Quiz;             //morphMany    
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

        // HasMany
            public function lesson_languages(){
                return $this->HasMany(Lesson_language::class);
            }

        // morphMany    
            public function quiz(){
                return $this->morphMany(Quiz::class, 'quizable'); // assignment
            }
        // morphOne
        public function notification(){
            return $this->morphOne(Notification::class, 'notificable');
        }
}


