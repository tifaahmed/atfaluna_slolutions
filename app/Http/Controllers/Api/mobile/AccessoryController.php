<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\Accessory\MobileAccessoryApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\AccessoryCollection as ModelCollection;
use App\Http\Resources\Mobile\AccessoryResource as ModelResource;

// lInterfaces
use App\Repository\AccessoryRepositoryInterface as ModelInterface;


class AccessoryController extends Controller
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
    public function attach(MobileAccessoryApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            foreach ($request->accessory_id as $key => $value) {
                $model->subUserAccessory()->attach($value);
            }
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
    public function  detach(MobileAccessoryApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserAccessory()->detach($request->accessory_id);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->accessory_id) )  ],
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