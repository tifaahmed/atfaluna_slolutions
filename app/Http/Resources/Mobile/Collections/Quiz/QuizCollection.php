<?php

namespace App\Http\Resources\Mobile\Collections\Quiz;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Mobile\Quiz\QuizResource as ModelResource;

class QuizCollection  extends ResourceCollection{

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
