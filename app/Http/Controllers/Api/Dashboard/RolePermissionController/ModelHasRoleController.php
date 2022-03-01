<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePermissionRequest\ModelHasRoleApiRequest ;
use Illuminate\Http\Response ;

use App\Models\User;
// use App\Models\Role;
use App\Http\Resources\Dashboard\RolePermissionResource\ModelHasRoleResource;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModelHasRoleController extends Controller
{

    public function store( ModelHasRoleApiRequest $request ) {
        $user = User::findOrFail($request->model_id);

        foreach($request->role_ids as $role_single_id){
            $role = Role::findOrFail($role_single_id);

            if (! $user->UserRole->contains($role_single_id) ) {
                // $user->UserRole()->attach($role_single_id, ['model_type' => $request->model_type]);
                $user->assignRole($role->name);

            }
            if($role->RolePermission){
                foreach($role->RolePermission as $role_single_row){
                    $permission_id = $role_single_row->pivot->permission_id    ;

                    if (! $user->UserPermission->contains($permission_id) ) {
                        // $user->UserPermission()->attach($permission_id, ['model_type' => $request->model_type]);
                        $permission = Permission::findOrFail($permission_id);
                        $user->givePermissionTo($permission->name) ;

                    } 

                }
            }
        }
        
        return $this -> MakeResponseSuccessful( 
            [ 'ModelHasRoleModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }

    public function destroy(ModelHasRoleApiRequest $request) {
        $user = User::findOrFail($request->model_id)->UserRole()->detach($request->role_ids);
        foreach($request->role_ids as $role_single_id){
            $role = Role::findOrFail($role_single_id);
            if ($role->RolePermission) {
                foreach($role->RolePermission as $role_single_row){
                    $permission_id = $role_single_row->pivot->permission_id    ;
                    $store = User::findOrFail($request->model_id)->UserPermission()->detach($request->permission_id);
                }            
            }
        }

        return $this -> MakeResponseSuccessful( 
            [ 'ModelHasRoleModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroyAll(Request $request) {
        User::findOrFail($request->model_id)->UserRole()->detach();
        return $this -> MakeResponseSuccessful( 
            [ 'ModelHasRoleModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }   
}
