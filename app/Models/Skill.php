<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Skill_language;
use App\Models\Skillable;

class Skill extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'skills';

    protected $fillable = [
     //
    ];
    //relation
    public function skill_languages(){
        return $this->HasMany(Skill_language::class);
    }
    public function skillable(){
        return $this->HasMany(Skillable::class);
    }


}
