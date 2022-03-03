<?php

namespace App\Http\Resources\Dashboard\Collections\RolePermissionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\RolePerssionResource\RoleHasPermissionResource;

class RoleHasPermissionCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $RoleHasPermission ) => new RoleHasPermissionResource ( $RoleHasPermission ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'status'   => true          ,
            'code'   => 200          ,
        ];
    }
}