<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson;
use App\Models\Activity_language;

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
    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id');
    }
    //relation
    public function activity_languages(){
        return $this->HasMany(Activity_language::class);
    }

}

