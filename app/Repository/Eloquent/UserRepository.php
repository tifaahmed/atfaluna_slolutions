<?php

namespace App\Repository\Eloquent;

use App\Models\User as ModelName;
use App\Repository\UserRepositoryInterface;
use Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(ModelName $model)
	{
		$this->model =  $model;
	}


    public function attachRole($UserRoles,$id){
		$result = $this->findById($id); 
        if($UserRoles){
            // $result->UserRole()->detach();
            return  Role::whereIn('id',$UserRoles)->get() ;
                // $result->assignRole($UserRoles);
                // $role = Role::findOrFail($row['id']);
                // if($role->RolePermission){
                //     foreach($role->RolePermission as $role_single_row){
                //         $permission_id = $role_single_row->pivot->permission_id    ;
                //         if (! $result->UserPermission->contains($permission_id) ) {
                //             $permission = Permission::findOrFail($permission_id);
                //             $result->givePermissionTo($permission->name) ;
                //         } 
                //     }
                // }
            
        }
    }




	
}

