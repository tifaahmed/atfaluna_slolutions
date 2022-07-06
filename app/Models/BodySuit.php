<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Accessory;          

class BodySuit extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'body_suits';
    protected $fillable = [
        'name',//required , [eye - leg - hand]
    ];
        // HasMany
        public function accessory(){
            return $this->HasMany(Accessory::class);
        }

    public function bodySuit_humanParts(){
        return $this->belongsToMany(HumanPart::class, 'body_suit_human_parts', 'body_suit_id', 'human_part_id');
    }
}
