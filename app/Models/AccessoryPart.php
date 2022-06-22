<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;

class AccessoryPart extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'accessory_parts';

    protected $fillable = [
        'name',//required , [fullset - headset]
        'accessory_id',
    ];
     // relations
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }
}
