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
            $sub_user = Sub_user::find($model->sub_user_id);
            $certificate = Certificate::find($model->certificate_id);
            if ( 
                $model->points  >=   $certificate->max_point  
                && 
                $certificate->certificatable_type == Age_group::class
            ) 
            {
                $age_group = Age_group::find($certificate->certificatable_id + 1);
                if ($age_group) {

                    $sub_user_age_group = $sub_user->subUserAgeGroup()->where('age_group_id',$age_group->id)->first();
                    if (!$sub_user_age_group) {
                        $sub_user->subUserAgeGroup()->syncWithoutDetaching([ $age_group->id]);
                        $subject_ids = $age_group->subjects()->get()->pluck('id')->toArray();
                        foreach ($subject_ids as $key => $subject_id) {
                            $sub_user->subUserSubject()->syncWithoutDetaching( [ $subject_id => ['active' => 1] ]);
                        }
                    }
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
