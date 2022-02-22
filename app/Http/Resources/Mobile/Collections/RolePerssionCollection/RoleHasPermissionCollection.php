<?php

namespace App\Http\Resources\Mobile\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\RolePerssionResource\RoleHasPermissionResource;

class RoleHasPermissionCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $RoleHasPermission ) => new RoleHasPermissionResource ( $RoleHasPermission ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'check'   => true          ,
        ];
    }
}