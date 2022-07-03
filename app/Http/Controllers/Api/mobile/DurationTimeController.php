<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\DurationTimeController\DurationTimeCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\DurationTimeController\DurationTimeResource as ModelResource;

// lInterfaces
use App\Repository\DurationTimeRepositoryInterface as ModelInterface;

class DurationTimeController extends Controller
{
    private $Repository;
    
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll( $request->type, $request->sub_user_id);

            return new ModelCollection ( $model )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
