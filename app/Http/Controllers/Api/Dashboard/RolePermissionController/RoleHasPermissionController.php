<?php

namespace App\Http\Controllers\Api\Dashboard\RolePermissionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\RolePerssionRequest\RoleHasPermissionApiRequest ;
use Illuminate\Http\Response ;

// use App\Models\Role;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionController extends Controller
{
 
    public function store( RoleHasPermissionApiRequest $request ) {
        $store = Role::findOrFail($request->role_id);
        foreach($request->permission_ids as $val){
            // if (! $store->RolePermission->contains($val)) {
                 // $store->RolePermission()->attach($val);
                 $store->givePermissionTo($val) ;

            // }
        }
        return $this -> MakeResponseSuccessful( 
            [ 'RoleModel'  =>'Successful'],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroy( RoleHasPermissionApiRequest $request ) {
        Role::findOrFail($request->role_id)->RolePermission()->detach($request->permission_ids);
        return $this -> MakeResponseSuccessful( 
            [ 'RoleModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    }
    public function destroyAll( Request $request ) {
        Role::findOrFail($request->role_id)->RolePermission()->detach();
        return $this -> MakeResponseSuccessful( 
            [ 'RoleModel'  => 'Successful' ],
            'Successful',
            Response::HTTP_OK
        ) ;
    } 
}
