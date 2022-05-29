<?php

namespace App\Http\Resources\Mobile\Collections\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\ControllerResources\SubjectController\SubUserQuizResource as ModelResource;

class SubUserQuizCollection extends ResourceCollection{

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
