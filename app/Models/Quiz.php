<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subject;
use App\Models\Quiz_language;

class Quiz extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'quizzes';

    protected $fillable = [
        'image',//required, max:5000
        'points',//required integer
        'subject_id',//unsigned
    ];
    // relations
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    // relations
    public function quiz_languages(){
        return $this->HasMany(Quiz_language::class);
        }
}

