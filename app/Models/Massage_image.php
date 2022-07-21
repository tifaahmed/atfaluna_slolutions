<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Massage;  // morphOne
use App\Models\Sub_user; // belongsTo

class Massage_image extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'massage_images';

    protected $fillable = [
        'image',//required, max:5000
        'sub_user_id',
    ];
    // relations

        // morphOne    
        public function massage(){
            return $this->morphOne(Massage::class, 'massagable');
        }
        // belongsTo
        public function sub_user(){
            return $this->belongsTo(Sub_user::class,'sub_user_id');
        }
}
// 