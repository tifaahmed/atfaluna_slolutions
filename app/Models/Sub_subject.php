<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Subject;                 // belongsTo

use App\Models\Sub_subject_language;    // HasMany
use App\Models\Lesson;                  // HasMany

use App\Models\Quiz;                    //morphMany    

class Sub_subject extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = ['id'];   

    protected $table = 'sub_subjects';

    protected $fillable = [
        'subject_id',//required integer unsigned
    ];
    // relations

        // belongsTo
            public function subject(){
                return $this->belongsTo(Subject::class,'subject_id');
            }

        // HasMany
            public function subSubject_languages(){
                return $this->HasMany(Sub_subject_language::class);
            }
            public function lessons(){
                return $this->HasMany(Lesson::class);
            }

        // morphMany    
            public function quiz(){
                return $this->morphMany(Quiz::class, 'quizable');
            }
}
