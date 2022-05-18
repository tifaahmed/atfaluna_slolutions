<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Str;

// Requests
use App\Http\Requests\Api\Skillable\SkillableApiRequest as modelInsertRequest;

// Resources
use App\Http\Resources\Dashboard\Collections\SkillableCollection as ModelCollection;
use App\Http\Resources\Dashboard\SkillableResource as ModelResource;

// lInterfaces
use App\Repository\SkillableRepositoryInterface as ModelInterface;

class SkillableController extends Controller
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

public function store(modelInsertRequest $request) {
    try {
        $model = new ModelResource( $this->ModelRepository->create( Request()->all() ) );

        return $this -> MakeResponseSuccessful( 
            [ $model ],
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
// trash
    public function collection_trash(Request $request){
        try {
            return new ModelCollection (  $this->ModelRepository->collection_trash( $request->PerPage ? $request->PerPage : 10 ) ) ;
        } catch (\Exception $e) {
            return $this -> MakeResponseErrors(  
                [$e->getMessage()  ] ,
                'Errors',
                Response::HTTP_NOT_FOUND
            );
        }
    }
    public function show_trash($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [new ModelResource ( $this->ModelRepository->findTrashedById($id) )  ],
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
    public function restore($id) {
        try {
            return $this -> MakeResponseSuccessful( 
                [ $this->ModelRepository->restorById($id)  ],
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
// trash

}