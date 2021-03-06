<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources

use App\Http\Resources\Mobile\Collections\ControllerResources\SubjectController\SubjectCollection as ModelCollection;
use App\Http\Resources\Mobile\ControllerResources\SubjectController\SubjectResource as ModelResource;
use App\Http\Requests\Api\Subject\MobileSubjectApiRequest;
use Illuminate\Support\Facades\Auth;

// lInterfaces
use App\Repository\SubjectRepositoryInterface as ModelInterface;


class SubjectController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll($request->sub_user_id,$request->age_group_id) ;
            return new ModelCollection ( $model )  ;
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
            $model =  $this->ModelRepository->filterPaginate($request->sub_user_id,$request->age_group_id,$request->PerPage ? $request->PerPage : 10) ;
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
    
    // relation
    public function attach(MobileSubjectApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            $model->subUserSubject()->syncWithoutDetaching($request->subject_ids);
            foreach ($request->subject_ids as $key => $subject_id) {
                $model->subUserSubject()->updateExistingPivot( $subject_id , ['active'=> isset($request->active[$key]) ? $request->active[$key] : 0 ] );
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

}