<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePermissionRequest\ModelHasPermissionApiRequest ;
use Illuminate\Http\Response ;

use App\Models\User;

use Spatie\Permission\Models\Permission;
class ModelHasPermissionController extends Controller
{

    public function store( ModelHasPermissionApiRequest $request ) {
        $store = User::findOrFail($request->model_id);
        foreach($request->permission_ids as $val){
            // if (! $store->UserPermission->contains($val) ) {
                $permission = Permission::findOrFail($val);
                $store->givePermissionTo($permission->name) ;
                // $store->UserPermission()->attach($val, ['model_type' => $request->model_type]);
            // }
        }
        return $this -> MakeResponseSuccessful( 
            [ 'ModelHasPermissionModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroy(ModelHasPermissionApiRequest $request) {
        $store = User::findOrFail($request->model_id)->UserPermission()->detach($request->permission_ids);
            return $this -> MakeResponseSuccessful( 
            [ 'ModelHasPermissionModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
         ) ;
    }
    public function destroyAll(Request $request) {
        $store = User::findOrFail($request->model_id)->UserPermission()->detach();
            return $this -> MakeResponseSuccessful( 
            [ 'ModelHasPermissionModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
         ) ;
    }    
}
