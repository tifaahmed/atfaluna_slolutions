<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Accessory_language;
use App\Models\Sub_user_accessory;

class Accessory extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'accessories';
    protected $fillable = [
        'image',//required , max:5000
        'price',//required , unsignedDecimal
        'gender',//required , enum ,['girl','boy','both']
        'type',//required 

    ];
    //relation
    public function accessory_languages(){
        return $this->HasMany(Accessory_language::class);
    }
    public function Sub_user_accessory(){
        return $this->HasMany(Sub_user_accessory::class);
    }
}
