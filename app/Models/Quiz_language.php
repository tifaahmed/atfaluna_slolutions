<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;


class Quiz_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'quiz_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'quiz_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function quiz(){
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
}
