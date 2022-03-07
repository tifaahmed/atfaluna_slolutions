<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\SubjectCollection as ModelCollection;
use App\Http\Resources\Mobile\SubjectResource as ModelResource;
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
    
// relation

        /*
        
        impload string=>array

        1.2.2.3
        [1,2,2,3]
        
        */
public function attach(MobileSubjectApiRequest $request){
    try {
        $model =   Auth::user()->sub_user()->find($request->sub_user_id);
        foreach ($request->subject_id as $key => $value) {
            $model->subUserSubject()->attach($value);
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
public function  detach(MobileSubjectApiRequest $request){
    try {
        $model = Auth::user()->sub_user()->find($request->sub_user_id); 
        $model->subUserSubject()->detach($request->subject_id);

        return $this -> MakeResponseSuccessful( 
            [new ModelResource ( $this->ModelRepository->findById($request->subject_id) )  ],
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