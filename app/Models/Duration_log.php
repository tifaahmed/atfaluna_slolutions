<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_user;


class Duration_log extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'duration_logs';

    protected $fillable = [
        'start',//required , date
        'sub_user_id',//unsigned
    ];
    // relations
    public function sub_user(){
        return $this->belongsTo(Sub_user::class,'sub_user_id');
    }

}
