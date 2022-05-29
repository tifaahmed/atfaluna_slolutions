<?php

namespace App\Http\Resources\Mobile\Collections\QuizAttempt;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\QuizAttempt\QuizAttemptResource as ModelResource;

class QuizAttemptCollection  extends ResourceCollection{

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
