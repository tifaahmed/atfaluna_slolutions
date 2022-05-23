<?php

namespace App\Http\Resources\Mobile\Collections\ControllerResources\authController;

use Illuminate\Http\Resources\Json\ResourceCollection;

// use App\Http\Resources\Mobile\SubUserResource as ModelResource;
use App\Http\Resources\Mobile\ControllerResources\authController\SubUserResource as ModelResource;


class SubUserCollection extends ResourceCollection{

    public function toArray( $request ) {
        return $this -> collection -> map( fn( $model ) => new ModelResource ( $model ) );
    }

    public function with( $request ) {
        return [
            'message' => 'Successful.' ,
            'status'   => true          ,
            'code'   => 200          ,
        ];
    }
}
