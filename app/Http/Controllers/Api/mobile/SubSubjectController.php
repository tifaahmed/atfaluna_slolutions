<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

// Requests
use App\Http\Requests\Api\SubSubject\SubSubjectApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Mobile\Collections\SubSubject\SubSubjectCollection as ModelCollection;
use App\Http\Resources\Mobile\SubSubject\SubSubjectResource as ModelResource;

// lInterfaces
use App\Repository\SubSubjectRepositoryInterface as ModelInterface;

class SubSubjectController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll($request->subject_id) ;
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
            $model =  $this->ModelRepository->filterPaginate($request->subject_id,$request->PerPage ? $request->PerPage : 10) ;
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
}