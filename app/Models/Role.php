<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'description',
        'guard_name'
    ];

    //relations
        public function RolePermission()
        {
            return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
        }
    //relations
    
}
