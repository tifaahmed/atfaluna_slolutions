<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Subject_language;       
use App\Models\Sub_subject_language;       

class Sound extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'sounds';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'record',// integer ,required , exists //   ex: subjects.id 
    ];
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
    
    public function subject_language()
    {
        return $this->morphedByMany(Subject_language::class, 'soundable','soundables');
    }
    public function sub_subject_language()
    {
        return $this->morphedByMany(Sub_subject_language::class, 'soundable','soundables');
    }
}
