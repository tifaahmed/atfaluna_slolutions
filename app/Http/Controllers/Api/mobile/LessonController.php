<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\Lesson\LessonCollection as ModelCollection;
use App\Http\Resources\Mobile\Lesson\LessonResource as ModelResource;


// lInterfaces
use App\Repository\LessonRepositoryInterface as ModelInterface;

use App\Http\Requests\Api\Lesson\MobileLessonApiRequest;

use Illuminate\Support\Facades\Auth;
class LessonController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            return $model =  $this->ModelRepository->filterAll($request->sub_user_id,$request->lesson_type_id) ;
            return new ModelCollection (  $model )  ;
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
            $model = $this->ModelRepository->filterPaginate($request->sub_user_id,$request->lesson_type_id, $request->PerPage ? $request->PerPage : 10);
            return new ModelCollection ($model)  ;
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
    public function attach(MobileLessonApiRequest $request){
        try {
            $model =   Auth::user()->sub_user()->find($request->sub_user_id);
            // foreach ($request->lesson_id as $key => $value) {
                $model->subUserLesson()->syncWithoutDetaching($request->lesson_ids,['score'=> $request->score]);
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
        public function  detach(MobileLessonApiRequest $request){
        try {
            $model = Auth::user()->sub_user()->find($request->sub_user_id); 
            $model->subUserlesson()->detach($request->lesson_id);

            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findById($request->lesson_id) )  ],
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