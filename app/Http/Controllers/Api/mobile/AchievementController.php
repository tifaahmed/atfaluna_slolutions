<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

// Requests
use App\Http\Requests\Api\Achievement\AchievementApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Achievement\AchievementUpdateApiRequest as modelUpdateRequest;
use App\Http\Requests\Api\Achievement\MobileAchievementApiRequest;

// Resources
use App\Http\Resources\Mobile\Collections\AchievementCollection as ModelCollection;
use App\Http\Resources\Mobile\AchievementResource as ModelResource;

// lInterfaces
use App\Repository\AchievementRepositoryInterface as ModelInterface;

class AchievementController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
        $this->folder_name = 'Achievement/'.Str::random(10).time();
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
    // relation
    public function attach(MobileAchievementApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            // foreach ($request->accessory_id as $key => $value) {
                $model->subUserAchievement()->syncWithoutDetaching($request->achievement_ids);
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
    public function  detach(MobileAchievementApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserAchievement()->detach($request->achievement_ids);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->achievement_ids) )  ],
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