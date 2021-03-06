<?php

namespace App\Http\Resources\Mobile\Collections\SubSubject;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\SubSubject\SubSubjectResource as ModelResource;
// use App\Http\Resources\Mobile\ControllerResources\SubjectController\SubSubjectResource;

class SubSubjectCollection  extends ResourceCollection{

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