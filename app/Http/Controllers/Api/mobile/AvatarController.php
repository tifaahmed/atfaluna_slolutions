<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


use App\Http\Requests\Api\Avatar\MobileAvatarApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\AvatarController\AvatarCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\AvatarController\AvatarResource as ModelResource;


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
    public function all(Request $request){
        try {
            $model = $this->ModelRepository->filterAll(
                $request->sub_user_id,
                $request->gender,
                $request->free,
                $request->bought
            );
            return new ModelCollection (  $model  );

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
            $model =  $this->ModelRepository->filterPaginate(
                $request->sub_user_id,
                $request->gender,
                $request->free,
                $request->bought,
                $request->PerPage ? $request->PerPage : 10
            ) ;             
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
    public function attach(MobileAvatarApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            $model->subUserAvatar()->where('sub_user_id',$request->sub_user_id)->update(['active'=> 0]);
            $model->subUserAvatar()->syncWithoutDetaching([$request->avatar_id => ['active' =>  1]]);
            
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