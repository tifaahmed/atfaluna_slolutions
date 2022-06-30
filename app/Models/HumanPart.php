<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessory;

class HumanPart extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    protected $table = 'human_parts';

    protected $fillable = [
        'name',//required , [fullset - headset]
    ];
     // relations
    public function accessory(){
        return $this->HasMany(Accessory::class);
    }
    public function bodySuit_humanParts(){
        return $this->belongsToMany(BodySuit::class, 'body_suit_human_parts', 'human_part_id', 'body_suit_id');
    }
}
