<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Achievement;

class AchievementImage extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'achivement_images';

    protected $fillable = [
    'image_one',//nullable , max:5000
    'image_two',//nullable , max:5000
    'points',//default('0');//[note: "ex ( 5 - 6)"]
    'achievement_id', //unsigned cascade 

    ];

    // relations
    public function achievement(){
        return $this->belongsTo(Achievement::class,'achievement_id');
    }

}
