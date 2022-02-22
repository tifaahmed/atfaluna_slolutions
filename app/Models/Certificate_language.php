<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;


class Certificate_language extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'certificate_languages';


    protected $fillable = [
        'title_one',//required
        'title_two',//required
        'subject',//required
        'language',//required ,limit 2
        'certificate_id',//unsigned cascade
    ];
    public $timestamps = false;
    //relation
    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificate_id');
    }

}
