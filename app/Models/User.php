<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use Hash ;

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
        'email',
        'password',
        'avatar',
        'birthdate',
        'phone',
        'country_id',
    ];
    public function getToken( ) : array { return [
        'token_type'    => 'Bearer'                                     ,
        'expires_in'    => null                                         ,
        'refresh_token' => null                                         ,
        'access_token'  => $this -> createToken( '' ) -> accessToken ,
    ] ; }


    //relations
        public function country(){
            return $this->belongsTo(Country::class);
        }
        public function UserPermission()
        {
            return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
        }
        public function UserRole()
        {
            return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
        }
    //relations


}
