<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mcq_question;              //morphedByMany
use App\Models\True_false_question;       //morphedByMany

class QuestionTag extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'question_tags';

    protected $fillable = [
        'title',// required , unique
    ];

    public function mcq_question()
    {
        return $this->morphedByMany(Mcq_question::class, 'question_tagables');
    }
 
    /**
     * Get all of the videos that are assigned this tag.
     */
    public function true_false_question()
    {
        return $this->morphedByMany(True_false_question::class, 'question_tagables');
    }
}
