<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subject;
use App\Models\Sub_subject_language;

class Sub_subject extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = ['id'];   

    protected $table = 'sub_subjects';

    protected $fillable = [
        'subject_id',//required integer unsigned
    ];
    // relations
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function subSubject_languages(){
        return $this->HasMany(Sub_subject_language::class);
    }
}
