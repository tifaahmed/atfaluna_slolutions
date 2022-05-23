<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subject;       
use App\Models\Sub_subject;
use App\Models\Lesson;              

class Skillable extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'skillables';

    protected $fillable = [
        'skill_id', // integer / default 0
        'skillable_id',//   required , integer , exists / ex  lesson_id , sub subject_id  , subject_id 
        'skillable_type',// required / ex Lesson , Sub_subject , Subject
    ];
    // relations

        // morphTo
            public function skillable(){
                return $this->morphTo('skillable');
            }
        // morphedByMany 
            public function subjects(){
                return $this->morphedByMany(Subject::class,'skillables');
            }
            public function sub_subjects(){
                return $this->morphedByMany(Sub_subject::class,'skillables');
            }   
            public function lessons(){
                return $this->morphedByMany(Lesson::class,'skillables');
            }

}

