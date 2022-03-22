<?php

namespace App\Http\Controllers\Api\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Resources
use App\Http\Resources\Mobile\Collections\PlayTimeCollection as ModelCollection;
use App\Http\Resources\Mobile\PlayTimeResource as ModelResource;
use App\Http\Requests\Api\PlayTime\PlayTimeApiRequest as modelInsertRequest;
use App\Http\Requests\Api\PlayTime\PlayTimeStoreArrayApiRequest as modelInsertArrayRequest;

// lInterfaces
use App\Repository\PlayTimeRepositoryInterface as ModelInterface;

class PlayTimeController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll($request->sub_user_id) ;
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
        return $model =$this->ModelRepository->filterPaginate( $request->sub_user_id,$request->PerPage ? $request->PerPage : 10);        try {
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
    public function attatchArray(modelInsertArrayRequest $request) {

        // try {
                  return $this->ModelRepository->attatchByArray( $request->all() ) ;
            // }
            // return $this -> MakeResponseSuccessful( 
            //     [ 'Successful' ],
            //     'Successful'               ,
            //     Response::HTTP_OK
            // ) ;
        // } catch (\Exception $e) {
        //     return $this -> MakeResponseErrors(  
        //         [$e->getMessage()  ] ,
        //         'Errors',
        //         Response::HTTP_BAD_REQUEST
        //     );
        // }
    } 
    public function store(modelInsertRequest $request) {
        try {
            $modal = new ModelResource( $this->ModelRepository->create( Request()->all() ));
            return $this -> MakeResponseSuccessful( 
                [ $modal ],
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_BAD_REQUEST
            );
        }
    } 
}