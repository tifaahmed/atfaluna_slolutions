<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Accessory_language;          // HasMany
use App\Models\Sub_user_avatar_accessory;     // HasMany

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
        public function sub_user_avatar_accessory()
        {
            return $this->hasManyThrough(
                Sub_user_avatar_accessory::class,
                Sub_user_accessory::class,
                'accessory_id',
                'sub_user_accessory_id');
        }

        // belongsTo
        public function BodySuit(){
            return $this->belongsTo(BodySuit::class,'body_suit_id');
        }

        // belongsToMany
        public function SubUserAccessory(){ // which Accessory  bought by SubUser
            return $this->belongsToMany(Sub_user::class, 'sub_user_accessories', 'accessory_id', 'sub_user_id')
            ->using(Sub_user_accessory::class)->withPivot('id');
        }
        



        public function AccessoryActivity(){ // which Accessory  belong to  activity
            return $this->belongsToMany(Activity::class, 'accessory_activities', 'accessory_id', 'activity_id');
        }
        public function AccessoryLesson(){// which Accessory  belong to  lesson
            return $this->belongsToMany(Lesson::class, 'accessory_lessons', 'accessory_id', 'lesson_id');
        }

        public function AccessorySkin(){ //which Accessory  belong to  skin
            return $this->belongsToMany(Skin::class, 'accessory_skins', 'accessory_id', 'skin_id');
        }
}
