<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Subscription_language;


class Subscription extends Model
{
    use HasFactory,SoftDeletes;
    public $guarded = ['id'];

    protected $table = 'subscriptions';

    protected $fillable = [
        'month_number', //not_null integer
        'child_number',  //not_null integer
        'price',        //unsignedDecimal
    ];

     //relation
        public function subscription_languages(){
            return $this->HasMany(Subscription_language::class);
        }
    //relation
    
}
