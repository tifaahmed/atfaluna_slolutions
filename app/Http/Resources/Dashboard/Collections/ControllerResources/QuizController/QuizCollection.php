<?php

namespace App\Http\Resources\Dashboard\Collections\ControllerResources\QuizController;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\ControllerResources\QuizController\QuizResource as ModelResource;

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
