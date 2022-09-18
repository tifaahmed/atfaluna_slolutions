<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword;

use App\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Role;
use App\Models\Sub_user;
use App\Models\User_package;
use App\Models\City;

// Notification
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\NewItemNotification;
use App\Notifications\ActiveEmailNotification;
use App\Notifications\ChatNotification;

use DB ;
use Carbon\Carbon;

class User extends Authenticatable {

    use
        HasApiTokens ,
        HasFactory   ,
        HasRoles     ,
        SoftDeletes ,
        Notifiable
    ;
    protected $table = 'users';

    public $guarded = ['id'];

    protected $hidden = [ 'password' ];

    protected $fillable = [
        'name',
        'email', //unique email_verified_atnullable
        'password', //not null
        'avatar', //null
        'birthdate', //null
        'phone', //unique
        'city_id', //unsigned
        'token',
        'remember_token',
        'login_type',
        'pin_code',
        'active'
    ];
    public function getToken( )  {
        return $token = $this -> createToken( $this->email )  ;
    }
    public function perviewToken($token) : array {
        return [
            'fcm_token'     => $token->token->fcm_token,
            'token_type'    => 'Bearer'                                     ,
            'expires_in'    => $token->token->expires_at                                         ,
            'refresh_token' => null                                         ,
            'access_token'  => $token->accessToken,
        ] ; 
    }
    protected static function boot()
    {
        parent::boot();
        User::creating(function ($model) {
            $model->pin_code = rand(111111,999999);
        });
        User::updating(function ($model) {
            $model->pin_code = rand(111111,999999);
        });
    }

    // Notification

        public function sendPasswordResetNotification($token)
        {
            $url = asset('api/auth/reset-password?token='.$token);

            $data = [] ;
            $data += ['url' => $url];
            $data += ['pin_code' => $this->pin_code];

            $this->notify(new ResetPasswordNotification($data));
        }

        public function sendActiveEmailNotification()
        {
            $data = ['pin_code' => $this->pin_code];

            $this->notify(new ActiveEmailNotification($data));
            
        }

        public function sendNewItemNotification($notification_data)
        {
            $all_parents =  User::role('parent')->get();
            foreach ($all_parents as $key => $user) {
                    if ($user->city) {
                        $user_country_lang = $user->city->government->country->first()->language;
                    }else{
                        $user_country_lang = 'ar';
                    }

                    for ($i=0; $i < count($notification_data) ; $i++) { 
                        $check_lang =  array_search($user_country_lang,$notification_data[$i],true) ;
                        if ($check_lang) {
                            foreach ($user->tokens as $key => $token) {
                                if ($token->fcm_token) {
                                    $notification_data[$i]['fcm_token']    =  $token->fcm_token;
                                    $user->notify(new NewItemNotification($notification_data[$i]));
                                }
                            }
                        }
                    }
                
            }
        }
        public function sendChatNotification($conversationData)
        {
            
            $user = $this->find($conversationData['user_id']);

            $data = ['priority' => $conversationData['priority']];
            $data = ['sub_user_id' => $conversationData['sub_user_id']];
            $data = ['user_id' => $conversationData['user_id']];
            $data = ['conversation_id' => $conversationData['conversation_id']];
            $data = ['text' => $conversationData['text']];
            $data = ['image' => $conversationData['image']];

            foreach ($user->tokens as $key => $token) {
                if ($token->fcm_token) {
                    $data = ['fcm_token' => $token->fcm_token];
                    $user->notify(new ChatNotification($data));
                }
            }

        }
        
    //Notifications

    //relations

        public function city(){
            return $this->belongsTo(City::class ,'city_id');
        }

        public function UserPermission(){
            return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
        }
        public function UserRole(){
            return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
        }
        public function sub_user(){
            return $this->hasMany(Sub_user::class);
        }
        public function userPackage(){
            return $this->hasMany(User_package::class);
        }
    //relations


}
