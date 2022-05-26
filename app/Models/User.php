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
use App\Models\Country;

// Notification
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\NewItemNotification;

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
        'country_id', //unsigned
        'token',
        'remember_token',
        'login_type',
        'latitude','longitude',
        'pin_code',
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
    public function sendPasswordResetNotification($token)
    {
        $url = asset('api/auth/reset-password?token='.$token);

        $data = [] ;
        $data += ['url' => $url];
        $data += ['pin_code' => $this->pin_code];

        $this->notify(new ResetPasswordNotification($data));
    }
    public function sendNewItemNotification($notification_data)
    {
        $all_users = $this->all();
        foreach ($all_users as $key => $user) {
            $user_country_lang = $user->country()->first()->language;
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
    //relations
        public function country(){
            return $this->belongsTo(Country::class);
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
