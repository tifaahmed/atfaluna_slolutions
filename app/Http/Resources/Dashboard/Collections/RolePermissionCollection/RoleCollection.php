<?php

namespace App\Http\Resources\Dashboard\Collections\RolePermissionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\RolePermissionResource\RoleResource;

class RoleCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $Role ) => new RoleResource ( $Role ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'status'   => true          ,
            'code'   => 200          ,
        ];
    }
}