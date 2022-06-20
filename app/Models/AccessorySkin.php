<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;
use App\Models\Skin;

class AccessorySkin extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'accessory_skins';
    public $timestamps = false;

    protected $fillable = [
        'skin_id',
        'accessory_id',
    ];
    // relations
    public function accessory(){
        return $this->belongsTo(Accessory::class,'accessory_id');
    }
    // relations
    public function skin(){
        return $this->belongsTo(Skin::class,'skin_id');
    }

} 
