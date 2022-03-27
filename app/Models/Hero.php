<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hero_language;
use App\Models\Lesson;

class Hero extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'heroes';

    protected $fillable = [
//
    ];
    //relation
    public function hero_languages(){
        return $this->HasMany(Hero_language::class);
    }
    public function herolesson(){
        return $this->belongsToMany(Lesson::class, 'hero_lessons', 'hero_id', 'lesson_id');
    }

}


