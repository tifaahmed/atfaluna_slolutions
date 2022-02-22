<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Basic extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'basics';


    protected $fillable = [
        'item', //not_null
        'info', //unique 
    ];
}
