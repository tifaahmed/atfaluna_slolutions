<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Accessory_language;


class Accessory extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'accessories';

    protected $fillable = [
        'image',//required , max:5000
        'price',//required , unsignedDecimal
    ];
    //relation
    public function accessory_languages(){
        return $this->HasMany(Accessory_language::class);
    }
}
