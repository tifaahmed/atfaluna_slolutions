<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;


class Duration_time extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'duration_times';

    protected $fillable = [
        'time_count',//required , float
        'sub_user_id',//required , unsigned
    ];
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
