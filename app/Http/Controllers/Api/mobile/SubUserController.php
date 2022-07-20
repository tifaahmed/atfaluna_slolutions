<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Request
use App\Http\Requests\Api\SubUser\MobileStoreSubUserApiRequest ;
// use App\Http\Requests\Api\User\MobileDeleteSubUserApiRequest ;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\subuserController\SubUserCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\subuserController\SubUserResource as ModelResource;

use App\Models\Sub_user;

use Illuminate\Support\Facades\Auth;
// Interfaces
use App\Repository\SubUserRepositoryInterface as ModelInterface;


class SubUserController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }

 

    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll($request->sub_user_id,$request->closest);
            return new ModelCollection (  $model ) ;
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
            $model =  $this->ModelRepository->filterPaginate(
                $request->sub_user_id,
                $request->closest,
                $request->PerPage ? $request->PerPage : 10) ;
            return new ModelCollection ( $model);
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
    
    public function store(MobileStoreSubUserApiRequest $request){
        try {
            $sub_user = Auth::user()->sub_user()->create( $request->all() );
            // attach one age group and only one can be active
            $this->ModelRepository->attachAgeGroupByAge($sub_user->age,$sub_user->id) ;
            $this->ModelRepository->attachAvatar($request->avatar_id,$sub_user->id) ;

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $sub_user )  ],
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

    public function update(Request $request,$id) {
        try {
            // rid of empty fields
            $array_filter = array_filter($request->all());

            $this->ModelRepository->update( $id,$array_filter) ;
            $this->ModelRepository->attachAvatar($request->avatar_id,$request->id) ;
            return $this->show($id);

        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        } 
    }
    
    public function destroy($id){
        try {
            return $this -> MakeResponseSuccessful( 
                [ Auth::user()->sub_user()->find($id)->delete() ],
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