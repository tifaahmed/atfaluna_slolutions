<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;

// Requests
use App\Http\Requests\Api\Activity\ActivityApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Activity\ActivityUpdateApiRequest as modelUpdateRequest;
use App\Http\Requests\Api\Activity\MobileActivityApiRequest;
// Resources
use App\Http\Resources\Mobile\Collections\Activity\ActivityCollection as ModelCollection;
use App\Http\Resources\Mobile\Activity\ActivityResource as ModelResource;

// lInterfaces
use App\Repository\ActivityRepositoryInterface as ModelInterface;

class ActivityController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(){
        try {
            return new ModelCollection (  $this->ModelRepository->all() )  ;
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
            return new ModelCollection (  $this->ModelRepository->collection( $request->PerPage ? $request->PerPage : 10) )  ;
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
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            $model->subUserActivity()->syncWithoutDetaching($request->activity_ids);
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