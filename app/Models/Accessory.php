<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Accessory_language; // HasMany
use App\Models\Sub_user_accessory; // HasMany

use App\Models\Activity;           // belongsToMany
use App\Models\Lesson;           // belongsToMany
use App\Models\Skin;           // belongsToMany

class Accessory extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'accessories';
    protected $fillable = [
        'image',//required , max:5000
        'price',//required , unsignedDecimal
        'gender',//required , enum ,['girl','boy','both']
        'body_suit_id'
    ];
    //relation

        // HasMany
        public function accessory_languages(){
            return $this->HasMany(Accessory_language::class);
        }
        public function Sub_user_accessory(){
            return $this->HasMany(Sub_user_accessory::class);
        }

        // belongsToMany
        public function AccessoryActivity(){
            return $this->belongsToMany(Activity::class, 'accessory_activities', 'accessory_id', 'activity_id');
        }
        public function AccessoryLesson(){
            return $this->belongsToMany(Lesson::class, 'accessory_lessons', 'accessory_id', 'lesson_id');
        }
        public function AccessorySkin(){
            return $this->belongsToMany(Skin::class, 'accessory_skins', 'accessory_id', 'skin_id');
        }
}
