<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Certificate;         // morphOne
use App\Models\Sub_user;            // belongsToMany

use App\Models\Age;                 // HasMany
use App\Models\Age_group_language;  // HasMany
use App\Models\Subject;             // HasMany


class Age_group extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'age_groups';

    protected $fillable = [
        // 'age',//required , integer

    ];
    // relations

        // morphOne
            public function certificate(){
                return $this->morphOne(Certificate::class, 'certificatable');
            }

        // belongsToMany    
            public function subUserAgeGroup(){
                return $this->belongsToMany(Sub_user::class, 'sub_user_age_groups', 'age_group_id', 'sub_user_id');
            }

        // HasMany
            public function subjects(){
                return $this->HasMany(Subject::class);
            }
            public function age_group_languages(){
                return $this->HasMany(Age_group_language::class);
            }
            public function age(){
                return $this->HasMany(Age::class);
            }
        
}
