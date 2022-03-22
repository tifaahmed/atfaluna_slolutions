<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Age_group;
use App\Models\Subject_language;
use App\Models\Certificate;
use App\Models\Sub_subject;
use App\Models\Lesson;
use App\Models\Quiz;

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'subjects';

    protected $fillable = [
        'image',//required , max:5000
        'points',//required integer
        'age_group_id',//unsigned
    ];
    // relations
        public function age_group(){
            return $this->belongsTo(Age_group::class,'age_group_id');
        }
        public function subject_languages(){
            return $this->HasMany(Subject_language::class);
        }
        public function certificate(){
            return $this->morphOne(Certificate::class, 'certificatable');
        }
        public function sub_subjects(){
            return $this->HasMany(Sub_subject::class);
        }
        public function lesssons(){
            return $this->hasManyThrough(Lesson::class, Sub_subject::class);
        }
        public function quizzes(){
            return $this->HasMany(Quiz::class);
        }
}
