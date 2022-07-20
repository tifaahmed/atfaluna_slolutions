<?php

namespace App\Http\Resources\Dashboard\Collections\MatchQuestion;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\MatchQuestion\MatchQuestionResource as ModelResource;

class MatchQuestionCollection  extends ResourceCollection{

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