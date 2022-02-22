<?php

namespace App\Http\Resources\Dashboard\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\RolePerssionResource\ModelHasRoleResource;

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