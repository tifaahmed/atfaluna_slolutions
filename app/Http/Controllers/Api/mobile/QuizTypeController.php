<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

//AgeGroupController
// Requests
use App\Http\Requests\Api\QuizType\QuizTypeApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Mobile\Collections\QuizTypeCollection as ModelCollection;
use App\Http\Resources\Mobile\QuizTypeResource as ModelResource;

// lInterfaces
use App\Repository\QuizTypeRepositoryInterface as ModelInterface;

class QuizTypeController extends Controller
{
    private $Repository;
    private $RepositoryLanguage;
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

}
