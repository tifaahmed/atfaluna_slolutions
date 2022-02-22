<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Age_group;
use App\Scopes\AncientScope;


class Age_group_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'age_group_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'age_group_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function age_group(){
        return $this->belongsTo(Age_group::class,'age_group_id');
    }
    public function scopeRelatedLanguage($query,$id){
        
        return $query->where('age_group_id', $id);
    }
    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
