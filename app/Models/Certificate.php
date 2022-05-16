<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Certificate_language;


class Certificate extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = ['id'];

    protected $table = 'certificates';

    protected $fillable = [
        'certificatable_id',//  ,morphs_id (subject_id , age_group_id)']
        'certificatable_type',// subject age_group
        'image_one',//required
        'image_two',//required
        'image_three',//required
        
        'min_point',//required integer
        'max_point',//required integer
    ];
    // relations
        public function certificate_languages(){
        return $this->HasMany(Certificate_language::class);
        }
        public function subUserCertificate(){
            return $this->belongsToMany(Certificate::class, 'sub_user_certificates', 'sub_user_id', 'certificate_id');
        }
        public function certificatable()
        {
            return $this->morphTo();
        }
}


