<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'description',
        'guard_name'
    ];

    public function UserPermission()
    {
      return $this->belongsToMany(User::class, 'model_has_permissions', 'permission_id', 'model_id');
    }
}
