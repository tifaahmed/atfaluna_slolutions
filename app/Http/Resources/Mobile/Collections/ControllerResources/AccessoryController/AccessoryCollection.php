<?php

namespace App\Http\Resources\Mobile\Collections\ControllerResources\AccessoryController;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\ControllerResources\AccessoryController\AccessoryResource as ModelResource;

class AccessoryCollection  extends ResourceCollection{

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
