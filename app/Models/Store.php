<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'stores';

    protected $fillable = [
        'image',//required , max:5000
        'url',//required unique URL, max:5000
    ];
    // relations
    public function store_languages(){
        return $this->HasMany(Store_language::class);
    }

}
