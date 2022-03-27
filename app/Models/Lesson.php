<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson_type;
use App\Models\Sub_subject;
use App\Models\Lesson_language;
use App\Models\Hero;

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
    public function subSubject(){
        return $this->belongsTo(Sub_subject::class,'sub_subject_id');
    }
    // relations
    public function lesson_type(){
        return $this->belongsTo(Lesson_type::class,'lesson_type_id');
    }
    // relations
    public function hero(){
        return $this->belongsTo(Hero::class,'hero_id');
    }
    //relation
    public function lesson_languages(){
        return $this->HasMany(Lesson_language::class);
    }
    public function herolesson(){
        return $this->belongsToMany(Hero::class, 'hero_lessons', 'lesson_id','hero_id' );
    }
}


