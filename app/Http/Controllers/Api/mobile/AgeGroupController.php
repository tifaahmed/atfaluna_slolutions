<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;

// Requests
use App\Http\Requests\Api\AgeGroup\MobileAgeGroupApiRequest;
use App\Http\Requests\Api\AgeGroup\MobileActiveAgeGroupApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\AgeGroupController\AgeGroupCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\AgeGroupController\AgeGroupResource as ModelResource;


// lInterfaces
use App\Repository\AgeGroupRepositoryInterface as ModelInterface;


class AgeGroupController extends Controller
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
        // return $request->language;
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
    public function attach(MobileAgeGroupApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            // foreach ($request->accessory_id as $key => $value) {
                $model->subUserAgeGroup()->syncWithoutDetaching($request->age_group_id);
            // }            
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

    // relation
    public function active(MobileActiveAgeGroupApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            $model->subUserAgeGroup()->update(['active'=> 0]);
            $model->subUserAgeGroup()->where('age_group_id',$request->age_group_id)->update(['active'=> 1]);
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