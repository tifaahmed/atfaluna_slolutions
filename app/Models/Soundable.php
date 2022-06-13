<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soundable extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'soundables';

    protected $fillable = [
        'sound_id',// integer ,required , unsigned , 
        'soundable_id',// integer ,required , exists //  ex: subjects.id 
        'soundable_type',// string , required // ex: Subjects
    ];
    public function soundable()
    {
        return $this->morphTo('soundable');
    }
}
