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

class LessonController extends Controller
{
    
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll(
                $request->sub_user_id,
                $request->lesson_type_id,
                $request->hero_id,
                $request->seen
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


    public function collection(Request $request){
        try {
            $model = $this->ModelRepository->filterPaginate(
                $request->sub_user_id,
                $request->lesson_type_id,
                $request->hero_id, 
                $request->seen,
                $request->prepage ? $request->prepage : 10);
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
    public function attach(MobileLessonApiRequest $request){
        try {
            $this->ModelRepository->handleLessson($request->sub_user_id,$request->lesson_id,$request->percentage) ;
            return $this -> MakeResponseSuccessful( 
                [ 'Successful' ],
                'Successful'    ,
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