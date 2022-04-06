<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Age_group;   //belongsTo

class Age extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'ages';

    protected $fillable = [
        'age',//required unique 
        'age_group_id',//unsigned 
    ];
    // relation
        //belongsTo
            public function age_group(){
                return $this->belongsTo(Age_group::class,'age_group_id');
            }
}
