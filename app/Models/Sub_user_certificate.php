<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;
use App\Models\Certificate;
use App\Models\Age_group;

class Sub_user_certificate extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'sub_user_certificates';
    public $timestamps = false;

    protected $fillable = [
        'sub_user_id',
        'certificate_id',
        'points',

    ];
    
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $sub_user = Sub_user::find(1);
            $certificate = Certificate::find($model->certificate_id);
            if ( 
                $model->points  >=   $certificate->max_point  
                && 
                $certificate->certificatable_type == Age_group::class
            ) 
            {
                $age_group = Age_group::find($certificate->certificatable_id + 1);
                if ($age_group) {
                    $sub_user->subUserAgeGroup()->syncWithoutDetaching([ $age_group->id]);
                }
            }
        });
    }
    // relations
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificate_id');
    }
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
