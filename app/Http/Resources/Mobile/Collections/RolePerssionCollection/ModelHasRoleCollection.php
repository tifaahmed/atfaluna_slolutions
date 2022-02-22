<?php

namespace App\Http\Resources\Mobile\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\RolePerssionResource\ModelHasRoleResource;

class ModelHasRoleCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $ModelHasRole ) => new ModelHasRoleResource ( $ModelHasRole ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'check'   => true          ,
        ];
    }
}