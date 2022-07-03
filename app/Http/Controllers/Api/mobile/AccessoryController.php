<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\Accessory\MobileAccessoryApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\ControllerResources\AccessoryController\AccessoryCollection as ModelCollection;

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
        // relation
    public function attach(MobileAccessoryApiRequest $request){
        try {
            $accessory = $this->ModelRepository->findById($request->accessory_id);
            $sub_user =   Auth::user()->sub_user()->find($request->sub_user_id);
            $sub_user_accessory = $sub_user->subUserAccessory()->where('accessory_id',$request->accessory_id)->first();
            if (!$sub_user_accessory) {
                if ($sub_user->points > $accessory->price) {
                    $sub_user->subUserAccessory()->syncWithoutDetaching($request->accessory_id);
                    $sub_user->update(['points'=> $sub_user->points - $accessory->price]) ;
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
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    public function toggle(MobileAccessoryApiRequest $request){
        $accessory = $this->ModelRepository->findById($request->accessory_id);
        $sub_user_accessory = $accessory->SubUserAccessory()->where('sub_user_id',$request->sub_user_id)->withPivot('active')->first();
        // if ($sub_user_accessory) {

            return $accessory->BodySuit()->get();

        // } else{
        //     return $this -> MakeResponseSuccessful( 
        //         ['child did not bought this before'],
        //         'Errors',
        //         Response::HTTP_BAD_REQUEST
        //     ) ;
        // }
        
    }

    
}
