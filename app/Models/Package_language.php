<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;


class Package_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'package_languages';


    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'package_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }

}
