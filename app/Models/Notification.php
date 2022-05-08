<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Notifications\InvoicePaid;


class Notification extends Model
{
    use HasFactory,SoftDeletes,Notifiable;
 
    public $guarded = ['id'];

    protected $table = 'notifications';

    protected $fillable = [
        'notificable_id',//  ,morphs_id (subject_id , lesson_id , sub_subject_id , quiz_id)']
        'notificable_type',// subject_model ,lesson_model , sub_subject_model , quiz_model
        'title',//not null
        'subject',//not null
    ];
    // relations
    // $user->notify(new InvoicePaid($invoice));
        public function notificable()
        {
            return $this->morphTo();
        }
}
