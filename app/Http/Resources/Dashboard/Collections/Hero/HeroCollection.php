<?php

namespace App\Http\Resources\Dashboard\Collections\Hero;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\Hero\HeroResource as ModelResource;

class HeroCollection  extends ResourceCollection{

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
//