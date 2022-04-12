<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Massage;// morphOne

class Massage_image extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'massage_images';

    protected $fillable = [
        'image',//required, max:5000
    ];
    // relations
    // morphOne    
    public function massage(){
        return $this->morphOne(Massage::class, 'massagable');
    }
}
// 