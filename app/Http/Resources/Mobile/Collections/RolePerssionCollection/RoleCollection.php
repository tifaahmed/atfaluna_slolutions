<?php

namespace App\Http\Resources\Mobile\Collections\RolePerssionCollection;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\RolePerssionResource\RoleResource;

class RoleCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $Role ) => new RoleResource ( $Role ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'check'   => true          ,
        ];
    }
}