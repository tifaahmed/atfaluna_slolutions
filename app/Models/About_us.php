<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class About_us extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'about_us';

    protected $fillable = [
        'title',//required 
        'subject',//required 
        'image_one',//required , max:5000
        'image_two',//required , max:5000
        'image_three',//required , max:5000
        'image_four',//required , max:5000
        'language',//required ,limit 2

    ];
    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
