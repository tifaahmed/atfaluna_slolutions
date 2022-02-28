<?php

namespace App\Http\Resources\Dashboard\Collections\RolePermissionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\RolePerssionResource\ModelHasPermissionResource;

class ModelHasPermissionCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $ModelHasPermission ) => new ModelHasPermissionResource ( $ModelHasPermission ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'check'   => true          ,
        ];
    }
}