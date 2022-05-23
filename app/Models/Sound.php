<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Subject;       

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
    
    public function subject()
    {
        return $this->morphedByMany(Subject::class, 'soundables');
    }
}
