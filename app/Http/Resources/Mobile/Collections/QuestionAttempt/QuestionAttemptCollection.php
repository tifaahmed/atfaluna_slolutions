<?php

namespace App\Http\Resources\Mobile\Collections\QuestionAttempt;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\QuestionAttempt\QuestionAttemptResource as ModelResource;

class QuestionAttemptCollection  extends ResourceCollection{

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
