<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson;
use App\Models\Activity_language;
use App\Models\Sub_user_activity;
use App\Models\Sub_user;
use App\Models\Accessory;

class Activity extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = ['id'];

    protected $table = 'activities';

    protected $fillable = [
        'points',//required default('0')
        'lesson_id',//unsigned 
    ];

    // relations
        // belongsTo
        public function lesson(){
            return $this->belongsTo(Lesson::class,'lesson_id');
        }

        // HasMany
        public function activity_languages(){
            return $this->HasMany(Activity_language::class);
        }

        // belongsToMany
        public function subUserActivity(){
            return $this->belongsToMany(Sub_user::class, 'sub_user_activities', 'activity_id', 'sub_user_id');
        }
        public function AccessoryActivity(){
            return $this->belongsToMany(Accessory::class, 'accessory_activities', 'activity_id', 'accessory_id');
        }
}

