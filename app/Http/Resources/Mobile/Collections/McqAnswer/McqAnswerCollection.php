<?php

namespace App\Http\Resources\Mobile\Collections\McqAnswer;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\McqAnswer\McqAnswerResource as ModelResource;

class McqAnswerCollection  extends ResourceCollection{

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