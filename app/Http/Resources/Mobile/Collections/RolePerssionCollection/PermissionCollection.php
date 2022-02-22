<?php

namespace App\Http\Resources\Mobile\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\RolePerssionResource\PermissionResource;

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