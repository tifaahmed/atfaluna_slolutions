<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;

use App\Http\Requests\Api\Language\LanguageApiRequest as modelInsertRequest;
use App\Http\Requests\Api\Language\LanguageUpdateApiRequest as modelUpdateRequest;


use App\Repository\LanguageRepositoryInterface as ModelInterface;

use App\Http\Resources\Dashboard\Collections\LanguageCollection as ModelCollection;
use App\Http\Resources\Dashboard\LanguageResource as ModelResource;

class LanguageController extends Controller
{
    private $LanguageRepository;
    public function __construct(ModelInterface $LanguageRepository)
    {
        $this->ModelRepository = $LanguageRepository;
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

    public function destroy($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [$this->ModelRepository->deleteById($id)] ,
                'Successful'               ,
                Response::HTTP_OK
            ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [ $e->getMessage()  ] ,
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

    public function update(modelUpdateRequest $request ,$id) {
        try {
            
            $this->ModelRepository->update( $id,Request()->all()) ;
            
            $modal = new ModelResource($this->ModelRepository->findById($id)); 

            return $this -> MakeResponseSuccessful( 
                    [ $modal],
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
