<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SubUserMessage extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'sub_user_messages';

    protected $fillable = [
        'massage_id',//  unsigned 
        'sub_user_id',// unsigned 
        'read',//  boolean , defoult 0
    ];


}
