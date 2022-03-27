<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hero;
use App\Models\Lesson;

class Hero_lesson extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'hero_lessons';
    public $timestamps = false;

    protected $fillable = [
        'heros_id',
        'lesson_id',
    ];
    // relations
    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id');
    }
    // relations
    public function hero(){
        return $this->belongsTo(Hero::class,'heros_id');
    }

}
