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
                $request->bought,
                $request->have_original_skin
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
                $request->have_original_skin,
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
    // buy avatar
    public function attach(MobileAvatarApiRequest $request){
        try {
            $avatar = $this->ModelRepository->findById($request->avatar_id);
            $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);

            $sub_user_avatar = $sub_user->subUserAvatar()->where('avatar_id',$request->avatar_id)->first();
            if (!$sub_user_avatar) {
                if ($sub_user->points > $avatar->price) {
                    // $sub_user->subUserAvatar()->update(['active'=> 0]);
                    $sub_user->subUserAvatar()->syncWithoutDetaching( [ $request->avatar_id => ['active'=> 0] ]);
                    $sub_user->update(['points'=> $sub_user->points - $avatar->price]) ;

                    return $this -> MakeResponseSuccessful( 
                        ['Successful'],
                        'Successful'               ,
                        Response::HTTP_OK
                    ) ;
                }else{
                    return $this -> MakeResponseSuccessful( 
                        ['child does not have enough points'],
                        'Errors'               ,
                        Response::HTTP_BAD_REQUEST
                    ) ;
                }
            }else{
                return $this -> MakeResponseSuccessful( 
                    ['child has bought this before'],
                    'Errors'               ,
                    Response::HTTP_BAD_REQUEST
                ) ;
            }
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    // buy avatar

    // switch between avatars
    public function toggle(MobileAvatarApiRequest $request){
        $avatar = $this->ModelRepository->findById($request->avatar_id);
        $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);

        $sub_user_avatar = $sub_user->subUserAvatar()->where('avatar_id',$request->avatar_id) ;
        if ($sub_user_avatar->first()) {
           
            // unactive all avatars of the user
            $sub_user->subUserAvatar()->update(['active'=> 0]);
            // active the avatar of the user
            $sub_user_avatar->update(['active'=> 1]);


            return $this -> MakeResponseSuccessful( 
                ['Successful'],
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        }else{
            return $this -> MakeResponseSuccessful( 
                ['child did not bought this before'],
                'Errors'               ,
                Response::HTTP_BAD_REQUEST
            ) ;
        }
    }

}