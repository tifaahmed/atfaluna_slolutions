<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;


// Requests
use App\Http\Requests\Api\Hero\HeroApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Hero\HeroUpdateApiRequest as modelUpdateRequest;

// Resources
use App\Http\Resources\Mobile\Collections\Hero\HeroCollection as ModelCollection;
use App\Http\Resources\Mobile\Hero\HeroResource as ModelResource;

// lInterfaces
use App\Repository\HeroRepositoryInterface as ModelInterface;

class HeroController extends Controller
{
    private $Repository;
    public function __construct(ModelInterface $Repository)
    {
        $this->ModelRepository = $Repository;
    }
    public function all(Request $request){
        try {
            $model =  $this->ModelRepository->filterAll($request->sub_user_id) ;
            if ( is_array($model) ) {
                return new ModelCollection (  $model )  ;
            }else{
                return $model ;
            }
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
            $model = $this->ModelRepository->filterPaginate( $request->sub_user_id , $request->PerPage ? $request->PerPage : 10)  ;
            if ( is_array($model) ) {
                return new ModelCollection (  $model )  ;
            }else{
                return $model ;
            }
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