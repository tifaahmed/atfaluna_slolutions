<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact_us extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'contact_us';

    protected $fillable = [
        'name',//required 
        'message',//required 
        'subject',//required 
        'email',//required 
        'status',//required 


    ];
    
}
