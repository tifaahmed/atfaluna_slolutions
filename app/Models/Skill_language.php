<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;


class Skill_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'skill_languages';


    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'skill_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function skill(){
        return $this->belongsTo(Skill::class,'skill_id');
    }
}
