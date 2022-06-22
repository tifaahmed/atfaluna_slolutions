<?php

namespace App\Http\Resources\Mobile\Collections\Duration;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\Duration\DurationTimeResource as ModelResource;

class DurationTimeCollection  extends ResourceCollection{

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