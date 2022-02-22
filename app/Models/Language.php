<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'languages';


    protected $fillable = [
        'name', //unique , limit 2
        'full_name',//unique , limit 20
    ];
}

