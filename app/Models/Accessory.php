<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Accessory_language;  // HasMany

use App\Models\BodySuit;            // belongsTo

use App\Models\Sub_user_accessory;  // belongsToMany
use App\Models\Activity;            // belongsToMany
use App\Models\Lesson;              // belongsToMany
use App\Models\Skin;                // belongsToMany

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
// scope
        public function scopeGender($query,$gender){
            if($gender){
                return $query->where('gender', $gender);
            }
        }
        // HasMany
        public function accessory_languages(){
            return $this->HasMany(Accessory_language::class);
        }

        // belongsTo
        public function BodySuit(){
            return $this->belongsTo(BodySuit::class,'body_suit_id');
        }

        // belongsToMany
        public function SubUserAccessory(){
            return $this->belongsToMany(Sub_user::class, 'sub_user_accessories', 'accessory_id', 'sub_user_id')->withPivot('active');
        }
        public function AccessoryActivity(){
            return $this->belongsToMany(Activity::class, 'accessory_activities', 'accessory_id', 'activity_id');
        }
        public function AccessoryLesson(){
            return $this->belongsToMany(Lesson::class, 'accessory_lessons', 'accessory_id', 'lesson_id');
        }
        public function AccessorySkin(){
            return $this->belongsToMany(Skin::class, 'accessory_skins', 'accessory_id', 'skin_id')->withPivot('active');
        }
}
