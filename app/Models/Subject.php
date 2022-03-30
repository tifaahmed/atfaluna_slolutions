<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Age_group;        //belongsTo

use App\Models\Subject_language; //HasMany
use App\Models\Sub_subject;      //HasMany

use App\Models\Lesson;           //hasManyThrough

use App\Models\Certificate;      //morphOne
use App\Models\Quiz;             //morphMany    

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

        // belongsTo
            public function age_group(){
                return $this->belongsTo(Age_group::class,'age_group_id');
            }

        // HasMany
            public function sub_subjects(){
                return $this->HasMany(Sub_subject::class);
            }
            public function subject_languages(){
                return $this->HasMany(Subject_language::class);
            }

        // hasManyThrough
            public function lesssons(){
                return $this->hasManyThrough(Lesson::class, Sub_subject::class);
            }

        // morphOne    
            public function certificate(){
                return $this->morphOne(Certificate::class, 'certificatable');
            }

        // morphMany    
            public function quizzes(){
                return $this->morphMany(Quiz::class, 'quizable');
            }
        
}
