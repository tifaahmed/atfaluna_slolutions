<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
use Illuminate\Support\Facades\App;


class Certificate_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'certificate_languages';

    protected $fillable = [
        'title_one',//required
        'title_two',//required
        'description',//required
        'language',//required ,limit 2
        'certificate_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificate_id');
    }
    public function scopeRelatedLanguage($query,$id){
        return $query->where('certificate_id', $id);
    }

    public function scopeLocalization($query){
        return $query->where('language', App::getLocale());
    }
}
