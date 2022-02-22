<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Avatar extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'avatars';


    protected $fillable = [
        'type',// enum ,['girl','boy']
        'image',//required, max:5000
        'price',//unsignedDecimal
    ];
}
