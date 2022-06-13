<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Requests
use App\Http\Requests\Api\Activity\ActivityApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Activity\ActivityUpdateApiRequest as modelUpdateRequest;
use App\Http\Requests\Api\Activity\MobileActivityApiRequest;
// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\ActivityController\ActivityCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\ActivityController\ActivityResource as ModelResource;

// lInterfaces
use App\Repository\ActivityRepositoryInterface as ModelInterface;

class ActivityController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll($request->lesson_id);
            return new ModelCollection ( $model )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function collection(Request $request){
        try {
            $model = $this->ModelRepository->filterPaginate( $request->lesson_id , $request->PerPage ? $request->PerPage : 10 );
            return new ModelCollection ( $model )  ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    
    public function show($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($id) )  ],
                'Successful',
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }

    // relation
    public function attach(MobileActivityApiRequest $request){
        try {
            $this->ModelRepository->handleActivity($request->sub_user_id,$request->activity_id,$request->percentage) ;
            return $this -> MakeResponseSuccessful( 
                ['Successful'],
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
}