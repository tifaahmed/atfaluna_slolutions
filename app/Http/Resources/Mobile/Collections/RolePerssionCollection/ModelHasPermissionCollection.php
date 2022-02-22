<?php

namespace App\Http\Resources\Mobile\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\RolePerssionResource\ModelHasPermissionResource;

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