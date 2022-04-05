<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Age_group_language;
use App\Models\Certificate;
use App\Models\Subject;


class Age_group extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'age_groups';

    protected $fillable = [
        // 'age',//required , integer

    ];
    // relations
        public function age_group_languages(){
            return $this->HasMany(Age_group_language::class);
        }
        
        public function certificate(){
            return $this->morphOne(Certificate::class, 'certificatable');
        }

    // HasMany
        public function subjects(){
            return $this->HasMany(Subject::class);
        }
}
