<?php

namespace App\Http\Resources\Dashboard\Collections\RolePermissionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\RolePermissionResource\PermissionResource;

class PermissionCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $Permission ) => new PermissionResource ( $Permission ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'check'   => true          ,
        ];
    }
}