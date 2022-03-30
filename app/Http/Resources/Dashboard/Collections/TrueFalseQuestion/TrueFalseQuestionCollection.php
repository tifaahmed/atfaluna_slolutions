<?php

namespace App\Http\Resources\Dashboard\Collections\TrueFalseQuestion;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Dashboard\TrueFalseQuestion\TrueFalseQuestionResource as ModelResource;

class TrueFalseQuestionCollection extends ResourceCollection{

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
