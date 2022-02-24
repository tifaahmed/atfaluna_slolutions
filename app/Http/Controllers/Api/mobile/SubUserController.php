<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

use App\Http\Requests\Api\SubUser\MobileAccessoryApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\SubUserCollection as ModelCollection;
use App\Http\Resources\Mobile\SubUserResource as ModelResource;

use Auth;
// lInterfaces
use App\Repository\SubUserRepositoryInterface as ModelInterface;


class SubUserController extends Controller
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
        public function storeAccessory(MobileAccessoryApiRequest $request){
            try {
                $model = Auth::user()->sub_user()->find($request->sub_user_id); 
                $model->subUserAccessory()->attach($request->accessory_id);

                return $this -> MakeResponseSuccessful( 
                    [  $model ],
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
        public function  deleteAccessory(MobileAccessoryApiRequest $request){
            try {
                $model = Auth::user()->sub_user()->find($request->sub_user_id); 
                $model->subUserAccessory()->detach($request->accessory_id);
                return $this -> MakeResponseSuccessful( 
                    [ 'Successful' ],
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