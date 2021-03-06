<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AchievementImage;
use App\Models\Achievement_language;

class Achievement extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'achievements';

    protected $fillable = [
    //
    ];
    // relations
    public function achivementImages(){
        return $this->HasMany(AchievementImage::class);
    }
    public function achievement_languages(){
        return $this->HasMany(Achievement_language::class);
    }
}
