<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Package_language;

class Package extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'packages';

    protected $fillable = [
        'price',//required , integer
        'image',//required, max:5000
        'points',//required , integer
    ];
    //relation
    public function package_languages(){
        return $this->HasMany(Package_language::class);
    }

}