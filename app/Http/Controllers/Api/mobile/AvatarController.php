<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


use App\Http\Requests\Api\Avatar\MobileAvatarApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\AvatarCollection as ModelCollection;
use App\Http\Resources\Mobile\AvatarResource as ModelResource;


// lInterfaces
use App\Repository\AvatarRepositoryInterface as ModelInterface;

use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
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
    public function attach(MobileAvatarApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserAvatar()->attach($request->avatar_id);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->avatar_id) )  ],
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
    public function  detach(MobileAvatarApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserAvatar()->detach($request->avatar_id);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->avatar_id) )  ],
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