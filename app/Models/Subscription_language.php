<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use Illuminate\Support\Facades\App;


class Subscription_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'subscription_languages';

    protected $fillable = [
        'name',//required
        'language',//required ,limit 2
        'subscription_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('subscription_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
