<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Accessory;            
use App\Models\HumanPart;            

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
        $sub_user_id = $request->sub_user_id;
        $accessory_id = $request->accessory_id;
        // new accessory
        $new_accessory = $this->ModelRepository->findById($request->accessory_id);
        $new_body_suit =  $new_accessory->BodySuit()->first();
        $new_human_parts =  $new_body_suit->bodySuit_humanParts()->get();
        $new_human_parts_ids =  $new_human_parts->pluck('id')->toArray();

        $new_accessory->SubUserAccessory()->where('sub_user_id',$sub_user_id)->update(['active'=> 1]);

        // old accessories
        $old_accessories_need_unactive = Accessory::whereHas('SubUserAccessory', function (Builder $query) use($sub_user_id,$accessory_id) {
            $query->where('sub_user_id',$sub_user_id);
            $query->where('accessory_id','!=',$accessory_id);
            $query->where('active',1);
        })
        ->whereHas('BodySuit', function (Builder $BodySuit_query) use($new_human_parts_ids)  {
            $BodySuit_query->whereHas('bodySuit_humanParts', function (Builder $humanParts_query) use($new_human_parts_ids){
                $humanParts_query->whereIn('human_part_id',$new_human_parts_ids);
            });
        })
        ->get();

        foreach ($old_accessories_need_unactive as $key => $value) {
            $value->SubUserAccessory()->where('sub_user_id',$sub_user_id)->update(['active'=> 0]);
        }
        return $this -> MakeResponseSuccessful( 
            ['Successful'],
            'Successful'               ,
            Response::HTTP_OK
        ) ;
    }

    
}
